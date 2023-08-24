<?php
require_once('../config.php');
class Master extends DBConnection
{
	private $settings;
	public function __construct()
	{
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct()
	{
		parent::__destruct();
	}

	function save_hotelry()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'desc'))) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if (isset($_POST['desc'])) {
			if (!empty($data)) $data .= ",";
			$data .= " `desc`='" . addslashes(htmlentities($desc)) . "' ";
		}
		if (empty($id)) {
			$sql = "INSERT INTO `hostelry` SET {$data} ";
			$save = $this->conn->query($sql);
			$id = $this->conn->insert_id;
		} else {
			$sql = "UPDATE `hostelry` SET {$data} WHERE id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if ($save) {
			if (isset($_FILES['img']) && count($_FILES['img']) > 0 && $_FILES['img']['error'][0] !== UPLOAD_ERR_NO_FILE) {
				$r = substr(time(), -4) . rand(1, 25);
				$location_dir = 'uploads/hostelry_' . $r;
				$dir = base_app . DIRECTORY_SEPARATOR . $location_dir;
				mkdir($dir, 0777, true);

				$data = " `photo`= '{$location_dir}' ";
				$this->conn->query("UPDATE `hostelry` SET {$data} WHERE id = '{$id}' ");
				for ($i = 0; $i < count($_FILES['img']['name']); $i++) {
					if ($_FILES['img']['error'][$i] === UPLOAD_ERR_OK) {
						move_uploaded_file($_FILES['img']['tmp_name'][$i], $dir . '/' . $_FILES['img']['name'][$i]);
					}
				}
			}

			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "New hostelry successfully saved.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = 'ber => ' . $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}


	function delete_hotelry()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `hostelry` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			if (is_dir(base_app . 'uploads/hostelry_' . $id)) {
				$file = scandir(base_app . 'uploads/hostelry_' . $id);
				foreach ($file as $img) {
					if (in_array($img, array('..', '.')))
						continue;
					unlink(base_app . 'uploads/hostelry_' . $id . '/' . $img);
				}
				rmdir(base_app . 'uploads/hostelry_' . $id);
			}
			$this->settings->set_flashdata('success', "Hostelry Package successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function save_package()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'desc'))) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if (isset($_POST['desc'])) {
			if (!empty($data)) $data .= ",";
			$data .= " `desc`='" . addslashes(htmlentities($desc)) . "' ";
		}
		if (empty($id)) {
			$sql = "INSERT INTO `packages` SET {$data} ";
			$save = $this->conn->query($sql);
			$id = $this->conn->insert_id;
		} else {
			$sql = "UPDATE `packages` SET {$data} WHERE id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if ($save) {
			if (isset($_FILES['img']) && count($_FILES['img']) > 0 && !empty($_FILES['img']['name'][0])) {
				$r = substr(time(), -4) . rand(1, 25);
				$location_dir = 'uploads/package_' . $r;
				$dir = base_app . DIRECTORY_SEPARATOR . $location_dir;
				mkdir($dir, 0777);

				$data = " `upload_path`= '{$location_dir}' ";
				$this->conn->query("UPDATE `packages` SET {$data} WHERE id = '{$id}' ");
				for ($i = 0; $i < count($_FILES['img']['name']); $i++) {
					move_uploaded_file($_FILES['img']['tmp_name'][$i], $dir . '/' . $_FILES['img']['name'][$i]);
				}
			}

			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "New Package successfully saved.");
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = 'ber => ' . $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}


	function delete_p_img()
	{
		extract($_POST);
		if (is_file($path)) {
			if (unlink($path)) {
				$resp['status'] = 'success';
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = 'unlink file failed.';
			}
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = 'unlink file failed. File do not exist.';
		}
		return json_encode($resp);
	}
	function delete_package()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `packages` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			if (is_dir(base_app . 'uploads/package_' . $id)) {
				$file = scandir(base_app . 'uploads/package_' . $id);
				foreach ($file as $img) {
					if (in_array($img, array('..', '.')))
						continue;
					unlink(base_app . 'uploads/package_' . $id . '/' . $img);
				}
				rmdir(base_app . 'uploads/package_' . $id);
			}
			$this->settings->set_flashdata('success', "Tour Package successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function book_tour()
	{
		extract($_POST);
		$data = " user_id = '" . $this->settings->userdata('id') . "' ";
		foreach ($_POST as $k => $v) {
			$data .= ", `{$k}` = '{$v}' ";
		}
		$save = $this->conn->query("INSERT INTO `book_list` set $data");
		if ($save) {
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function update_book_status()
	{
		extract($_POST);
		$update = $this->conn->query("UPDATE `book_list` set `status` = '{$status}' where id ='{$id}' ");
		if ($update) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Book successfully updated.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function register()
	{
		extract($_POST);
		$data = "";
		$_POST['password'] = md5($password);
		foreach ($_POST as $k => $v) {
			if (!empty($data)) $data .= ",";
			$data .= " `{$k}`='{$v}' ";
		}
		$check = $this->conn->query("SELECT * FROM `users` where username='{$username}' ")->num_rows;
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Username already taken.";
			return json_encode($resp);
			exit;
		}
		$save = $this->conn->query("INSERT INTO `users` set $data ");
		if ($save) {
			foreach ($_POST as $k => $v) {
				$this->settings->set_userdata($k, $v);
			}
			$this->settings->set_userdata('id', $this->conn->insert_id);
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function update_account()
	{
		extract($_POST);
		$data = "";
		if (!empty($password)) {
			$_POST['password'] = md5($password);
			if (md5($cpassword) != $this->settings->userdata('password')) {
				$resp['status'] = 'failed';
				$resp['msg'] = "Current Password is Incorrect";
				return json_encode($resp);
				exit;
			}
		}
		$check = $this->conn->query("SELECT * FROM `users`  where `username`='{$username}' and `id` != $id ")->num_rows;
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Username already taken.";
			return json_encode($resp);
			exit;
		}
		foreach ($_POST as $k => $v) {
			if ($k == 'cpassword' || ($k == 'password' && empty($v)))
				continue;
			if (!empty($data)) $data .= ",";
			$data .= " `{$k}`='{$v}' ";
		}
		$save = $this->conn->query("UPDATE `users` set $data where id = $id ");
		if ($save) {
			foreach ($_POST as $k => $v) {
				if ($k != 'cpassword')
					$this->settings->set_userdata($k, $v);
			}

			$this->settings->set_userdata('id', $this->conn->insert_id);
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function save_inquiry()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!empty($data)) $data .= ",";
			$data .= " `{$k}`='{$v}' ";
		}
		$save = $this->conn->query("INSERT INTO `inquiry` set $data");
		if ($save) {
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function rate_review()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if ($k == 'review')
				$v = addslashes(htmlentities($v));
			if (!empty($data)) $data .= ",";
			$data .= " `{$k}`='{$v}' ";
		}
		$data .= ", `user_id`='" . $this->settings->userdata('id') . "' ";

		$save = $this->conn->query("INSERT INTO `rate_review` set $data");
		if ($save) {
			$resp['status'] = 'success';
			// $this->settings->set_flashdata("success","Rate & Review submitted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function delete_inquiry()
	{
		$del = $this->conn->query("DELETE FROM `inquiry` where id='{$_POST['id']}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata("success", "Inquiry Deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function delete_review()
	{
		$del = $this->conn->query("DELETE FROM `rate_review` where id='{$_POST['id']}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata("success", "Feedback Deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function accept_review()
	{
		$del = $this->conn->query("UPDATE `rate_review` SET status = 1 WHERE id='{$_POST['id']}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata("success", "Feedback Accepted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function delete_booking()
	{
		$del = $this->conn->query("DELETE FROM `book_list` where id='{$_POST['id']}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata("success", "Booking Deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}


	function save_comment()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$resp = array();

			$anonim_name = $this->conn->real_escape_string($_POST['anonim_name']);
			$review = $this->conn->real_escape_string($_POST['review']);
			$rate = $this->conn->real_escape_string($_POST['rate']);
			$package_id = $this->conn->real_escape_string($_POST['package_id']);
			$captcha = $this->conn->real_escape_string($_POST['captcha']);
			$rep['anonim_name'] = $anonim_name;
			$rep['review'] = $review;
			$rep['rate'] = $rate;
			$rep['package id'] = $package_id;
			$rep['captha'] = $captcha;
			//  $rep['photo'] = $_FILES['photo'];

			// Check if photo is uploaded
			if (isset($_FILES['photo']) && $_FILES['photo']['error'] !== UPLOAD_ERR_NO_FILE) {
				$photo = $_FILES['photo'];

				if ($photo['error'] !== UPLOAD_ERR_OK) {
					$resp['status'] = 'failed';
					$resp['error'] = 'Error uploading file: ' . $photo['error'];
					echo json_encode($resp);
					return;
				}

				$photo_name = $photo['name'];
				$photo_path = 'uploads/comments/' . $photo_name;

				if (!file_exists('uploads/comments')) {
					mkdir('uploads/comments', 0777, true);
				}

				if (!move_uploaded_file($photo['tmp_name'], $photo_path)) {
					$resp['status'] = 'failed';
					$resp['error'] = 'Error moving file to destination';
					echo json_encode($resp);
					return;
				}

				$query = "INSERT INTO rate_review (user_id, anonim_name, package_id, rate, review, photo,status) VALUES (6, '$anonim_name', '$package_id', '$rate', '$review', '$photo_path',0)";
			} else {
				$query = "INSERT INTO rate_review (user_id, anonim_name, package_id, rate, review, photo,status) VALUES (6, '$anonim_name', '$package_id', '$rate', '$review', NULL,0)";
			}

			$secretKey = "6LcJzHghAAAAAMoZbsbGGISBjkVfT6m6fg7kKODA";
			// post request to server
			$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
			$response = file_get_contents($url);
			$responseKeys = json_decode($response, true);

			if ($responseKeys["success"]) {
				$save = $this->conn->query($query);

				if ($save) {
					$resp['status'] = 'success';
					$resp['message'] = 'Rate & Review submitted.';
				} else {
					$resp['status'] = 'failed';
					$resp['error'] = $this->conn->error;
				}
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = 'Spam Detected!';
			}

			echo json_encode($resp);
		}
	}


	function save_video()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$id = $this->conn->real_escape_string($_POST['id']);

			if ($id) {
				$name = $this->conn->real_escape_string($_POST['name']);
				$desc = $this->conn->real_escape_string($_POST['desc']);
				$video = $_FILES['video'];

				if ($video['error'] !== UPLOAD_ERR_OK) {
					$resp['status'] = 'failed';
					$resp['error'] = 'Error uploading file: ' . $video['error'];
					return json_encode($resp);
				}

				$video_name = $video['name'];
				$video_path = 'uploads/video/' . $video_name;

				if (!file_exists('uploads/video')) {
					mkdir('uploads/video', 0777, true);
				}

				if (!move_uploaded_file($video['tmp_name'], $video_path)) {
					$resp['status'] = 'failed';
					$resp['error'] = 'Error moving file to destination';
					return json_encode($resp);
				}

				$query = "UPDATE video SET name='$name', description='$desc', loc='$video_path' WHERE id=$id";;
				$save = $this->conn->query($query);

				if ($save) {
					$resp['status'] = 'success';
					$this->settings->set_flashdata("success", "Updated.");
				} else {
					$resp['status'] = 'failed';
					$resp['error'] = $this->conn->error;
				}
			} else {
				$name = $this->conn->real_escape_string($_POST['name']);
				$desc = $this->conn->real_escape_string($_POST['desc']);
				$video = $_FILES['video'];

				if ($video['error'] !== UPLOAD_ERR_OK) {
					$resp['status'] = 'failed';
					$resp['error'] = 'Error uploading file: ' . $video['error'];
					return json_encode($resp);
				}

				$video_name = $video['name'];
				$video_path = 'uploads/video/' . $video_name;

				if (!file_exists('uploads/video')) {
					mkdir('uploads/video', 0777, true);
				}

				if (!move_uploaded_file($video['tmp_name'], $video_path)) {
					$resp['status'] = 'failed';
					$resp['error'] = 'Error moving file to destination';
					return json_encode($resp);
				}

				$query = "INSERT INTO video (name, description, loc) VALUES ('$name', '$desc', '$video_path')";
				$save = $this->conn->query($query);

				if ($save) {
					$resp['status'] = 'success';
					$this->settings->set_flashdata("success", " submitted.");
				} else {
					$resp['status'] = 'failed';
					$resp['error'] = $this->conn->error;
				}
			}


			return json_encode($resp);
		}
	}

	function delete_chat()
	{
		$getIP = $this->conn->query("SELECT ip_address FROM `shout_box` where id = '{$_POST['id']}' ");
		$row = $getIP->fetch_assoc();
		$ipAddress = $row['ip_address'];
		$del = $this->conn->query("DELETE FROM `shout_box` where ip_address='{$ipAddress}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata("success", "Chat Deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function reply_chat()
	{
		$saveReply = $this->conn->query("INSERT INTO shout_box (user, message, ip_address) VALUES ('Admin', '{$_POST['message']}', '{$_POST['ip_address']}')");

		if ($saveReply) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata("success", "Chat saved.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function delete_category()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `categories` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Category successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_cat()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!empty($data)) $data .= ",";
			$data .= " `{$k}`='{$v}' ";
		}
		if (empty($id)) {
			$save = $this->conn->query("INSERT INTO `categories` set $data");
		} else {
			$sql = "UPDATE `categories` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if ($save) {
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save_cat':
		echo $Master->save_cat();
		break;
	case 'delete_category':
		echo $Master->delete_category();
		break;
	case 'reply_chat':
		echo $Master->reply_chat();
		break;
	case 'delete_chat':
		echo $Master->delete_chat();
		break;
	case 'save_video':
		echo $Master->save_video();
		break;
	case 'save_hotelry':
		echo $Master->save_hotelry();
		break;
	case 'delete_hotelry':
		echo $Master->delete_hotelry();
		break;
	case 'save_package':
		echo $Master->save_package();
		break;
	case 'delete_package':
		echo $Master->delete_package();
		break;
	case 'delete_p_img':
		echo $Master->delete_p_img();
		break;
	case 'book_tour':
		echo $Master->book_tour();
		break;
	case 'update_book_status':
		echo $Master->update_book_status();
		break;
	case 'register':
		echo $Master->register();
		break;
	case 'update_account':
		echo $Master->update_account();
		break;
	case 'save_inquiry':
		echo $Master->save_inquiry();
		break;
	case 'rate_review':
		echo $Master->rate_review();
		break;
	case 'delete_inquiry':
		echo $Master->delete_inquiry();
		break;
	case 'delete_booking':
		echo $Master->delete_booking();
		break;
	case 'delete_review':
		echo $Master->delete_review();
		break;
	case 'accept_review':
		echo $Master->accept_review();
		break;
	case 'save_comment':
		echo $Master->save_comment();
		break;
	default:
		// echo $sysset->index();
		break;
}