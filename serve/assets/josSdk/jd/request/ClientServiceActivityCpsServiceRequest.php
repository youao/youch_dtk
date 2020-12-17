<?php
class ClientServiceActivityCpsServiceRequest
{
	private $apiParas = array();
	
	public function getApiMethodName(){
	  return "jingdong.client.service.ActivityCpsService";
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
                                    	                   			private $activityid;
    	                        
	public function setActivityid($activityid){
		$this->activityid = $activityid;
         $this->apiParas["activityid"] = $activityid;
	}

	public function getActivityid(){
	  return $this->activityid;
	}

                        	                   			private $subunionid;
    	                        
	public function setSubunionid($subunionid){
		$this->subunionid = $subunionid;
         $this->apiParas["subunionid"] = $subunionid;
	}

	public function getSubunionid(){
	  return $this->subunionid;
	}

                        	                   			private $pid;
    	                        
	public function setPid($pid){
		$this->pid = $pid;
         $this->apiParas["pid"] = $pid;
	}

	public function getPid(){
	  return $this->pid;
	}

                        	                   			private $ext1;
    	                        
	public function setExt1($ext1){
		$this->ext1 = $ext1;
         $this->apiParas["ext1"] = $ext1;
	}

	public function getExt1(){
	  return $this->ext1;
	}

                        	}





        
 

