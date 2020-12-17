<?php
class KplOpenSearchAssociationalWordRequest
{
	private $apiParas = array();
	
	public function getApiMethodName(){
	  return "jd.kpl.open.search.associational.word";
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
    private  $mapResuest;

    public function setMapResuest($mapResuest){
        $this->apiParas['mapResuest'] = $mapResuest;
    }
    public function getMapResuest(){
        return $this->apiParas['mapResuest'];
    }
}

?>