<?php
header("Content-type:text/html;charset=GBK");
include_once 'Sender.php';

/**
 * �ӿڲ�����
 * 
 * ��ʽ����ʱ��������Ʒ��Ϣ����Ҫ�ϸ���д��
 *	���ҳ������ʽGBK�ģ��������ļ���ҳ��ı�����һ�µģ����������������ļ��Ļ�
 * @var
 */

      //  $service = new Service();
		
        $order = new Order();
        //$order -> setOrderNo($_POST["orderNo"]);      // ���ö������
        //$order -> setOrderNo($_GET["orderNo"]);
        $a = rand(0,999999);
        $b = rand(1,100000);
        $c = rand(0,999999);
    	$orderno = $a+$b.$c;      	

        $order -> setOrderNo("000000");
	  
        $order -> setOrderTime("2012-04-05 10:09:09");  // �����µ�ʱ��
        $order -> setUpdateTime("2012-04-05 20:09:09"); // ���ö�������ʱ�䣬���û���µ�ʱ�䣬Ҫ��ǰ�Խ�����ǰ˵��
        $order -> setCampaignId("101");                 // ����ʱʹ��"101"����ʽ����֮��id����Ҫ��cookie�л�ȡ
        $order -> setFeedback("NDgwMDB8dGVzdA==");			// ����ʱʹ��"101"����ʽ����֮��id����Ҫ��cookie�л�ȡ
        $order -> setFare("10");                        // �����ʷ�
        $order -> setFavorable("30");                   // �����Ż�ȯ
		$order -> setFavorableCode("30YHM"); 
		$order -> setOrderStatus("active");             // ���ö���״̬
        $order -> setPaymentStatus("1");   				// ����֧��״̬
        $order -> setPaymentType("֧����");		// ֧����ʽ


        $pro = new Product();                           // ������Ʒ����1
        //$pro -> setOrderNo($order -> getOrderNo());     // ���ö�����ţ��������Ҫ���¶�Ӧ
        $pro -> setProductNo("1001");                   // ������Ʒ���
        $pro -> setName("������Ʒ6");                   // ������Ʒ����
        $pro -> setCategory("asdf");                    // ������Ʒ����
        $pro -> setCommissionType("A");                 // ����Ӷ�����ͣ��磺��ͨ��Ʒ Ӷ�������10%��Ӷ���ţ������ж���Ȼ��֪ͨ˫������A
        $pro -> setAmount("1");                         // ������Ʒ����
        $pro -> setPrice("3000");                       // ������Ʒ�۸�

        $pro1 = new Product();
       // $pro1 -> setOrderNo($order -> getOrderNo());
        $pro1 -> setProductNo("1002");
        $pro1 -> setName("������Ʒ5");
        $pro1 -> setCategory("a");
        $pro1 -> setCommissionType("B");
        $pro1 -> setAmount("3");
        $pro1 -> setPrice("100");

        $pro2 = new Product();
       // $pro2 -> setOrderNo($order -> getOrderNo());
        $pro2 -> setProductNo("1003");
        $pro2 -> setName("������Ʒ4");
        $pro2 -> setCategory("2");
        $pro2 -> setCommissionType("B");
        $pro2 -> setAmount("5");
        $pro2 -> setPrice("500");

        $products = array($pro,$pro1,$pro2);    // ʵ����Ʒ��Ϣ����
		$order -> setProducts($products);
		
        //var_dump(get_object_vars($order));
		$sender = new Sender();
		$sender -> setOrder($order);
	    $sender -> sendOrder();

?>