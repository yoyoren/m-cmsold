<?php	
	/**
	 * Config����������ļ�"yiqifa-config.php",����ȡ������Ӧ�Ĳ���ֵ��<p>
	 * ��̬����{@link #getString(String key)}���ݴ���"key"��ȡ�����ļ�"yiqifa-config.properties"�Ķ�Ӧ��ֵ,û�ж�Ӧ�Ĳ������ؿմ���
	 * 
	 * @author zhangxing 
	 * @version 1.0.0
	 * @see com.emar.yiqifa.api.advertiser.AdEnter
	 * @since 0.1.0
	 */		
	class Config{
		function Config(){
			if(file_exists(ROOT_PATH."api/yiqifa-config.php")){
				include_once 'api/yiqifa-config.php';
			}else{
				include_once '../yiqifa-config.php';
				
			}
		}
		
		function getString($paramname){
			return constant($paramname);
		}
	}
?>