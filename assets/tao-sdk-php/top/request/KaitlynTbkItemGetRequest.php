<?php
/**
 * TOP API: taobao.tbk.uatm.event.get request
 * 
 * @author auto create
 * @since 1.0, 2016.04.29
 */
class KaitlynTbkItemGetRequest
{
	/** 
	 * 需要返回的字段列表，不能为空，字段名之间使用逗号分隔
	 **/
	// private $num_iids;
	private $pid;//三方pid，满足mm_xxx_xxx_xxx格式
	
	/** 
	 * 默认1，第几页，从1开始计数
	 **/
	private $pageNo;
	
	/** 
	 * 默认20,  页大小，即每一页的活动个数
	 **/
	private $pageSize;
	
	private $apiParas = array();
	
	// public function setFields($fields)
	// {
	// 	$this->fields = $fields;
	// 	$this->apiParas["fields"] = $fields;
	// }

	// public function getFields()
	// {
	// 	return $this->fields;
	// }

	public function setPid($pid)
	{
		$this->pid = $pid;
		$this->apiParas["pid"] = $pid;
	}

	public function setPageNo($pageNo)
	{
		$this->pageNo = $pageNo;
		$this->apiParas["page_no"] = $pageNo;
	}

	public function getPageNo()
	{
		return $this->pageNo;
	}

	public function setPageSize($pageSize)
	{
		$this->pageSize = $pageSize;
		$this->apiParas["page_size"] = $pageSize;
	}

	public function getPageSize()
	{
		return $this->pageSize;
	}

	public function getApiMethodName()
	{
		return "taobao.tbk.item.coupon.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->pid,"pid");
	}
	
	// public function putOtherTextParam($key, $value) {
	// 	$this->apiParas[$key] = $value;
	// 	$this->$key = $value;
	// }
}
