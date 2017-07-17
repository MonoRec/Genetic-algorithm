<?php


class profilePanel {

	public function clickProfile() {
		return "<a href='profile.php?user_id=".$_SESSION['user_session']."'> Profile </a>";
	}

}