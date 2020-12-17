<?php
class KeplerSettledAftermarketQueryservicepageRequest
{
	private $apiParas = array();
	
	public function getApiMethodName(){
	  return "jd.kepler.settled.aftermarket.queryservicepage";
	}
	
	public function getApiParas(){
        if(empty($this->apiParas)){
	        return "{}";
	    }
		return json_encode($this->apiParas);
	}
	
	public function check(){
		
	}
	
    public function putOtherTextParam($key, $value){
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}

    private  $version;

    public function setVersion($version){
        $this->version = $version;
    }

    public function getVersion(){
        return $this->version;
    }
    private  $queryServicePageParam;

    public function setQueryServicePageParam($queryServicePageParam){
        $this->apiParas['queryServicePageParam'] = $queryServicePageParam;
    }
    public function getQueryServicePageParam(){
        return $this->apiParas['queryServicePageParam'];
    }
    private  $client;

    public function setClient($client){
        $this->apiParas['client'] = $client;
    }
    public function getClient(){
        return $this->apiParas['client'];
    }
}

?>