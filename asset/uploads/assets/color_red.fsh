
varying vec4 v_fragmentColor;	
varying vec2 v_texCoord;	
		
void main()			
{
	vec4 v_orColor = v_fragmentColor * texture2D(CC_Texture0, v_texCoord);
	float red = dot(v_orColor.rgb, vec3(1, 1, 1));
	gl_FragColor = vec4(red, 0, 0, v_orColor.a);
}				
