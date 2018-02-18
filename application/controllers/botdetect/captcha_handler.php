<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Captcha_handler extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->is_get_resource_contents_request()) {
            // getting contents of css, js, and gif files.
            $this->get_resource_contents();
        } else {
            // getting captcha image, sound, validation result
            $this->load_botdetect_captcha_library();
            $command_string = $this->input->get('get');

            if (!BDC_StringHelper::HasValue($command_string)) {
                BDC_HttpHelper::BadRequest('command');
            }

            $command = BDC_CaptchaHttpCommand::FromQuerystring($command_string);
            switch ($command) {
                case BDC_CaptchaHttpCommand::GetImage:
                    $response_body = $this->get_image();
                    break;
                case BDC_CaptchaHttpCommand::GetSound:
                    $response_body = $this->get_sound();
                    break;
                case BDC_CaptchaHttpCommand::GetValidationResult:
                    $response_body = $this->get_validation_result();
                    break;
                default:
                    BDC_HttpHelper::BadRequest('command');
            }

            // disallow audio file search engine indexing
            $this->output
                    ->set_header('X-Robots-Tag: noindex, nofollow, noarchive, nosnippet')
                    ->cache(0)
                    ->set_output($response_body);
        }
    }

    public function get_resource_contents()
    {
        $filename = $this->input->get('get');

        if (!preg_match('/^[a-z-]+\.(css|gif|js)$/', $filename)) {
            $this->bad_request('Invalid file name.');
        }

        $resource_path = $this->get_resource_path();

        if (is_null($resource_path)) {
            $this->bad_request('Resource folder could not be found.');
        }

        $file_path = $resource_path . $filename;

        if (!is_file($file_path)) {
            $this->bad_request(sprintf('File "%s" could not be found.', $filename));
        }

        $file_info  = pathinfo($file_path);
        $this->output
                ->set_content_type($file_info['extension'])
                ->set_output(file_get_contents($file_path));
    }

    private function get_resource_path()
    {
        if (!defined('DS')) { define('DS', DIRECTORY_SEPARATOR); }
        $outer = FCPATH . '../../lib/botdetect/public/';
        $inner_root_dir = FCPATH . 'lib' . DS . 'botdetect' . DS . 'public' . DS;
        $inner_app_dir = APPPATH . 'libraries' . DS . 'botdetect' . DS . 'lib' . DS . 'botdetect' . DS .'public' . DS;

        if (is_dir($inner_app_dir)) { return $inner_app_dir; }
        if (is_dir($outer)) { return $outer; }
        if (is_dir($inner_root_dir)) { return $inner_root_dir; }

        return null;
    }

    private function load_botdetect_captcha_library()
    {
        $captcha_id = $this->input->get('c');

        if (isset($captcha_id) && preg_match("/^(\w+)$/ui", $captcha_id)) {
            $this->load->library('botdetect/BotDetectCaptcha', array('captchaConfig' => $captcha_id));
        } else {
            $this->bad_request('Invalid captcha id.');
        }
    }

    public function get_image() {

        if (is_null($this->botdetectcaptcha)) {
            BDC_HttpHelper::BadRequest('captcha');
        }

        // identifier of the particular Captcha object instance
        $instance_id = $this->get_instance_id();
        if (is_null($instance_id)) {
            BDC_HttpHelper::BadRequest('instance');
        }

        // response headers
        BDC_HttpHelper::DisallowCache();

        // response MIME type & headers
        $mime_type = $this->botdetectcaptcha->CaptchaBase->ImageMimeType;
        $this->output->set_content_type($mime_type);

        // image generation
        $raw_image = $this->botdetectcaptcha->CaptchaBase->GetImage($instance_id);
        $this->botdetectcaptcha->CaptchaBase->SaveCodeCollection();
        return $raw_image;
    }

    public function get_sound()
    {
        if (is_null($this->botdetectcaptcha)) {
            BDC_HttpHelper::BadRequest('captcha');
        }

        // identifier of the particular Captcha object instance
        $instance_id = $this->get_instance_id();
        if (is_null($instance_id)) {
            BDC_HttpHelper::BadRequest('instance');
        }

        // response MIME type & headers
        $mime_type = $this->botdetectcaptcha->CaptchaBase->SoundMimeType;
        $this->output->set_content_type($mime_type);

        // sound generation
        $raw_sound = $this->botdetectcaptcha->CaptchaBase->GetSound($instance_id);
        return $raw_sound;
    }

    public function get_validation_result()
    {
        if (is_null($this->botdetectcaptcha)) {
            BDC_HttpHelper::BadRequest('captcha');
        }

        // identifier of the particular Captcha object instance
        $instance_id = $this->get_instance_id();
        if (is_null($instance_id)) {
            BDC_HttpHelper::BadRequest('instance');
        }

        $mime_type = 'application/json';
        $this->output->set_content_type($mime_type);

        // code to validate
        $user_input = $this->get_user_input();

        // JSON-encoded validation result
        $result = $this->botdetectcaptcha->AjaxValidate($user_input, $instance_id);
        $this->botdetectcaptcha->CaptchaBase->SaveCodeCollection();

        $result_json = $this->get_json_validation_result($result);

        return $result_json;
    }

    private function get_instance_id()
    {
        $instance_id = $this->input->get('t');
        if (!BDC_StringHelper::HasValue($instance_id) ||
            !BDC_CaptchaBase::IsValidInstanceId($instance_id)) {
            return;
        }
        return $instance_id;
    }

    // extract the user input Captcha code string from the Ajax validation request
    private function get_user_input()
    {
        // BotDetect built-in Ajax Captcha validation
        $input = $this->input->get('i');

        if (empty($input)) {
            // jQuery validation support, the input key may be just about anything,
            // so we have to loop through fields and take the first unrecognized one
            $recognized = array('get', 'c', 't', 'd');
            foreach ($this->input->get(NULL, TRUE) as $key => $value) {
                if (!in_array($key, $recognized)) {
                    $input = $value;
                    break;
                }
            }
        }

        return $input;
    }

    // encodes the Captcha validation result in a simple JSON wrapper
    private function get_json_validation_result($result)
    {
        $result_str = ($result ? 'true': 'false');
        return $result_str;
    }

    private function is_get_resource_contents_request()
    {
        $http_get_data = $this->input->get(NULL, TRUE);
        return array_key_exists('get', $http_get_data) && !array_key_exists('c', $http_get_data);
    }

    private function bad_request($message)
    {
        $this->output->set_content_type('text/plain');
        $this->output->set_status_header('400');
        echo $message;
        exit;
    }
}
