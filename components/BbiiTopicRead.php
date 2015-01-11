<?php
class BbiiTopicRead implements Serializable {
	private $data;
	private $topics = array();
	
	public function setRead($topicId, $postId) {
		$this->topics[$topicId] = $postId;
	}
	
	public function topicLastRead($topicId) {
		if(isset($this->topics[$topicId])) {
			return $this->topics[$topicId];
		} else {
			return 0;
		}
	}
	
	public function serialize() {
		$this->data = array();
		$this->data['topics'] = $this->topics;
		$serialized = serialize($this->data);
		return gzencode($serialized);
	}
	
	public function unserialize($data) {
		$data = gzdecode($data);
		$this->data = unserialize($data);
		$this->topics = $this->data['topics'];
    }
}