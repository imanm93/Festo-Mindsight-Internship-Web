<?php

/**
 * ReportChartController
 *
 * LICENSE
 *
 * This file contains unreleased software code that is the
 * property of Festo Didactic Inc.
 *
 * @category Mercedes
 * @package Reports
 * @copyright Copyright (c) 2006-2013 Festo Didactic Inc. (http://www.labvolt.com)
 * @license
 * @author Iman Kalyan Majumdar
 * @version 0.1
 */

class Reports_ChartController extends Mercedes_Controller_Action
{

	/*
	 * infoAction
	 * Generates view to choose group and select required chart
	 */
	public function infoAction()
	{
		$this->initView();
		$this->view->groups = $this->getGroups();
		$this->setTrack(array($this->tr->_('Main Menu') => '/menu/main',
							  $this->tr->_('Reports') => '/menu/report',
							  $this->tr->_('Charts') => '/reports/chart/info'));
		$this->render('chartChooseGroup');
	}

	/*
	 * gencoursegradesbyuserprogressAction
	 * Generates the barchart for all course grades for a user in a group along with their progress
	 */
	public function gencoursegradebyuserprogressAction()
	{
		$this->initView();
		$this->view->g_id = $this->getRequest()->getParam('gid');
		$this->view->passing_grade = $this->getPassingGrade();	
		$data = $this->updatecourseprogressAction($this->view->g_id, false);
		$this->view->data = $data['data'];
		$this->view->last_user = $data['last_user'];
		$this->setTrack(array($this->tr->_('Main Menu') => '/menu/main',
							  $this->tr->_('Reports') => '/menu/report',
							  $this->tr->_('Charts') => '/reports/chart/info',
							  $this->tr->_('Course Grade by User (P)') => '/menu/reports/chart/gencoursegradebyuserprogress'));
		$this->render('chartCourseGradeswithProgress');
	}

	/*
	 * gencoursedetailAction
	 * Generates the barchart for all individual lesson grades in a course taken by the users in a group
	 */
	public function gencoursedetailAction()
	{
		$this->initView();
		$this->view->g_id = $this->getRequest()->getParam('gid');
		$this->view->passing_grade = $this->getPassingGrade();
		$data = $this->updatecoursedetailAction($this->view->g_id, false);
		$this->view->data = $data['data'];
		$this->view->last_course = $data['last_course'];
		$this->view->last_user = $data['last_user'];
		$this->setTrack(array($this->tr->_('Main Menu') => '/menu/main',
							  $this->tr->_('Reports') => '/menu/report',
							  $this->tr->_('Charts') => '/reports/chart/info',
							  $this->tr->_('Course Detail') => '/menu/reports/chart/gencoursedetail'));
		$this->render('chartCourseDetail');	
	}

	/*
	 * gencatdetailAction
	 * Generates the barchart for all individual course grades in a catalog taken by the users in a group 
	 */
	public function gencatdetailAction()
	{
		$this->initView();
		$this->view->g_id = $this->getRequest()->getParam('gid');
		$this->view->passing_grade = $this->getPassingGrade();
		$data = $this->updatecatalogdetailAction($this->view->g_id, false);
		$this->view->data = $data['data'];
		$this->view->last_catalog = $data['last_catalog'];
		$this->view->last_user = $data['last_user'];
		$this->setTrack(array($this->tr->_('Main Menu') => '/menu/main',
							  $this->tr->_('Reports') => '/menu/report',
							  $this->tr->_('Charts') => '/reports/chart/info',
							  $this->tr->_('Catalog Detail') => '/menu/reports/chart/gencatdetail'));
		$this->render('chartCatalogDetail');
	}

	/*
	 * genusergradebycatAction
	 * Generates the barchart for all user grades by catalog in a group
	 */
	public function genusergradebycatAction()
	{
		$this->initView();
		$this->view->g_id = $this->getRequest()->getParam('gid');
		$this->view->passing_grade = $this->getPassingGrade();	
		$data = $this->updatecatalogAction($this->view->g_id, false);	
		$this->view->data = $data['data'];
		$this->view->last_catalog = $data['last_catalog'];
		$this->setTrack(array($this->tr->_('Main Menu') => '/menu/main',
							  $this->tr->_('Reports') => '/menu/report',
							  $this->tr->_('Charts') => '/reports/chart/info',
							  $this->tr->_('User Grade by Catalog') => '/menu/reports/chart/genusergradebycat'));
		$this->render('chartUserGradebyCatalog');
	}

	/*
	 * gencatgradebyuserAction
	 * Generates the barchart for all catalog grades by user in a group
	 */
	public function gencatgradebyuserAction()
	{
		$this->initView();
		$this->view->g_id = $this->getRequest()->getParam('gid');
		$this->view->passing_grade = $this->getPassingGrade();
		$data = $this->updateusercatalogAction($this->view->g_id, false);
		$this->view->data = $data['data'];
		$this->view->current_uid = $data['u_pointer'];
		$this->view->last_user = $data['last_user'];
		$this->view->current_uname = $data['u_name'];
		$this->view->current_username = $data['username'];
		$this->setTrack(array($this->tr->_('Main Menu') => '/menu/main',
							  $this->tr->_('Reports') => '/menu/report',
							  $this->tr->_('Charts') => '/reports/chart/info',
							  $this->tr->_('Catalog Grade by User') => '/menu/reports/chart/gencatgradebyuser'));
		$this->render('chartCatalogGradebyUser');
	}
	
	/*
	 * genusergradebycourseAction
	 * Generates the barchart for all user grades by course in a group
	 */
	public function genusergradebycourseAction()
	{
		$this->initView();
		$this->view->g_id = $this->getRequest()->getParam('gid');
		$this->view->passing_grade = $this->getPassingGrade();
		$data = $this->updatecourseAction($this->view->g_id, false);
		$this->view->data = $data['data'];
		$this->view->last_course = $data['last_course'];
		$this->setTrack(array($this->tr->_('Main Menu') => '/menu/main',
							  $this->tr->_('Reports') => '/menu/report',
							  $this->tr->_('Charts') => '/reports/chart/info',
							  $this->tr->_('User Grade by Course') => '/menu/reports/chart/genusergradebycourse'));
		$this->render('chartUserGradebyCourse');  
	}

	/*
	 * gencoursegradebyuserAction
	 * Generates the barchart for all course grades for a user in a group
	 */
	public function gencoursegradebyuserAction()
	{
		$this->initView();
		$this->view->g_id = $this->getRequest()->getParam('gid');
		$this->view->passing_grade = $this->getPassingGrade();
		$data = $this->updateusercourseAction($g_id, false);
		$this->view->data = $data['data'];
		$this->view->current_uid = $data['current_pointer'];
		$this->view->current_uname = $data['u_name'];
		$this->view->current_username = $data['username'];		 
		$this->view->last_user = $data['last_user'];
		$this->setTrack(array($this->tr->_('Main Menu') => '/menu/main',
							  $this->tr->_('Reports') => '/menu/report',
							  $this->tr->_('Charts') => '/reports/chart/info',
							  $this->tr->_('Course Grade by User') => '/menu/reports/chart/gencoursegradebyuser'));
		$this->render('chartCourseGradebyUser');
	}

	/*
	 * updatecourseprogressAction
	 * Updates the barchart for the current user in the view
	 * @param int group_id
	 * @return array containing the data for the barchart, the user name and limit for the buttons in the view
	 */
	public function updatecourseprogressAction($group_id, $append = true)
	{
		require_once Zend_Registry::get('appPath'). '/reports/models/ReportData.php';

		$group_id = $this->getRequest()->getParam('gid');

		$users = $this->getGroupUserIDs($group_id);
		$courses = $this->getGroupCourseIDs($group_id);

		if (!($this->groupExists($group_id)))
			throw new Zend_Exception(print_r("The group selected does not exist!", true));
		else if ($users == null)
			throw new Zend_Exception(print_r("There are no users in this group.", true));
		else if ($courses == null)
			throw new Zend_Exception(print_r("There are no courses assigned to the group.", true));

		if ($append)
		{
			$user_pointer = $this->getRequest()->getParam('upointer');
		}
		else
		{
			$user_pointer = 0;
		}

		$user_id = $users[$user_pointer]['id'];
		$u_name = $users[$user_pointer]['u_name'];
		$username = $users[$user_pointer]['username'];

		$result = array();

		foreach ($courses as $course) 
		{
			$data = array(ReportData::RSgetCourseDetail($course['id'], $user_id));
			$progress_details = $this->getProgress($data);
			//$progress_details = $this->getProgresswithWeights($data);
			$result[] = array('u_name' => $u_name, 'username' => $username, 'course_id' => $data[0]['id'], 'course_title' => $data[0]['title'], 'version' => $data[0]['version'], 'grade' => $data[0]['average'], 'progress' => $progress_details['progress'], 'count' => $progress_details['count']);
		}

		if ($append)
			$this->getResponse()->appendBody(Zend_Json::encode($result));

		return array('data' => $result, 'u_name' => $u_name, 'username' => $username, 'last_user' => count($users));

	}

	/*
	 * updatescoursedetailAction
	 * Updates the barchart for the current course and user in the view
	 * @param int group_id
	 * @return array containing the data for the barchart, the course and user names and limit for the buttons in the view
	 */
	public function updatecoursedetailAction($group_id, $append = true)
	{
		require_once Zend_Registry::get('appPath'). '/reports/models/ReportData.php';

		$group_id = $this->getRequest()->getParam('gid');

		$users = $this->getGroupUserIDs($group_id);
		$courses = $this->getGroupCourseIDs($group_id);

		if (!($this->groupExists($group_id)))
			throw new Zend_Exception(print_r("The group selected does not exist!", true));
		else if ($users == null)
			throw new Zend_Exception(print_r("There are no users in this group.", true));
		else if ($courses == null)
			throw new Zend_Exception(print_r("There are no courses assigned to the group.", true));

		if ($append)
		{
			$course_pointer = $this->getRequest()->getParam('cpointer');
			$user_pointer = $this->getRequest()->getParam('upointer');
		}
		else
		{
			$course_pointer = 0;
			$user_pointer = 0;
		}

		$user_id = $users[$user_pointer]['id'];
		$u_name = $users[$user_pointer]['u_name'];
		$username = $users[$user_pointer]['username'];
		$c_id = $courses[$course_pointer]['id'];

		$course_detail = array(ReportData::RSgetCourseDetail($c_id, $user_id));

		foreach ($course_detail as $items) {
			foreach ($items['grades'] as $item) {
				$data[] = array('u_name' => $u_name, 'username' => $username, 'course_id' => $items['id'], 'course_title' => $items['title'], 'version' => $items['version'], 'lesson_title' => $item['title'], 'lesson_average' => $item['average']);
			}
		}

		if ($append)
			$this->getResponse()->appendBody(Zend_Json::encode($data));

		return array('data' => $data, 'last_course' => count($courses), 'last_user' => count($users));
	}

	/*
	 * updatescatalogdetailAction
	 * Updates the barchart for the current catalog and user in the view
	 * @param int group_id
	 * @return array containing the data for the barchart, the catalog and user pointers and limit for the buttons in the view
	 */
	public function updatecatalogdetailAction($group_id, $append = true)
	{
		require_once Zend_Registry::get('appPath'). '/reports/models/ReportData.php';

		$group_id = $this->getRequest()->getParam('gid');

		$users = $this->getGroupUserIDs($group_id);
		$catalogs = $this->getGroupCatalogIDs($group_id);

		if (!($this->groupExists($group_id)))
			throw new Zend_Exception(print_r("The group selected does not exist!", true));
		else if ($users == null)
			throw new Zend_Exception(print_r("There are no users in this group.", true));
		else if ($catalogs == null)
			throw new Zend_Exception(print_r("There are no catalogs assigned to the group.", true));

		if ($append)
		{
			$catalog_pointer = $this->getRequest()->getParam('catpointer');
			$user_pointer = $this->getRequest()->getParam('upointer');
		}
		else		
		{
			$catalog_pointer = 0;
			$user_pointer = 0;
		}

		$cat_id = $catalogs[$catalog_pointer];
		$user_id = $users[$user_pointer]['id'];
		$u_name = $users[$user_pointer]['u_name'];
		$username = $users[$user_pointer]['username'];

		$data = array();

		$items = array(ReportData::RSgetCatalogDetails($cat_id, $user_id));

		foreach ($items as $item) {
			foreach($item['grades'] as $course)
			{
				if ($course['catalog'] != null)
				{
					$course_title = $course['catalog'];
					$course_grade = $course['average'];
				}
				else
				{
					$course_title = $course['course'];
					$course_grade = $course['average'];
				}

				$data[] = array('parent' => $item['catalog'], 'child' => $course_title, 'grade' => $course_grade, 'u_name' => $u_name, 'username' => $username);
			}
		}
		
		if ($append)
			$this->getResponse()->appendBody(Zend_Json::encode($data));

		return array('user_pointer' => $user_pointer, 'catalog_pointer' => $catalog_pointer, 'data' => $data, 'last_catalog' => count($catalogs), 'last_user' => count($users));

	}

	/*
	 * updatescourseAction
	 * Updates the barchart for the current course in the view
	 * @param int group_id
	 * @return array containing the data for the barchart and limit for the buttons in the view
	 */
	public function updatecourseAction($group_id, $append = true)
	{
		require_once Zend_Registry::get('appPath'). '/reports/models/ReportData.php';

		$group_id = $this->getRequest()->getParam('gid');
		
		$users = $this->getGroupUserIDs($group_id);
		$courses = $this->getGroupCourseIDs($group_id);

		if (!($this->groupExists($group_id)))
			throw new Zend_Exception(print_r("The group selected does not exist!", true));
		else if ($users == null)
			throw new Zend_Exception(print_r("There are no users in this group.", true));
		else if ($courses == null)
			throw new Zend_Exception(print_r("There are no courses assigned to the group.", true));

		if ($append)
			$course_pointer = $this->getRequest()->getParam('cpointer');
		else 
			$course_pointer = 0;

		$c_id = $courses[$course_pointer]['id'];
		$c_version = $courses[$course_pointer]['version'];

		$data = array();

		foreach($users as $user_id)
		{
			$item = ReportData::RSgetCourseAverage($c_id, $user_id['id']);
			$data[] = array( 'name' => $user_id['u_name'], 'c_title' => $item['title'], 'version' => $c_version, 'grade' => $item['average']);
		}
		
		if($append)
			$this->getResponse()->appendBody(Zend_Json::encode($data));

		return array('data' => $data, 'last_course' => count($courses));
	}

	/*
	 * updatescatalogAction
	 * Updates the barchart for the current catalog in the view
	 * @param int group_id
	 * @return array containing the data for the barchart and limit for the buttons in the view
	 */
	public function updatecatalogAction($group_id, $append = true)
	{
		require_once Zend_Registry::get('appPath'). '/reports/models/ReportData.php';

		$group_id = $this->getRequest()->getParam('gid');

		$users = $this->getGroupUserIDs($group_id);
		$catalogs = $this->getGroupCatalogIDs($group_id);

		if (!($this->groupExists($group_id)))
			throw new Zend_Exception(print_r("The group selected does not exist!", true));
		else if ($users == null)
			throw new Zend_Exception(print_r("There are no users in this group.", true));
		else if ($catalogs == null)
			throw new Zend_Exception(print_r("There are no catalogs assigned to the group.", true));

		if ($append)
			$catalog_pointer = $this->getRequest()->getParam('catpointer');
		else 
			$catalog_pointer = 0;

		$cat_id = $catalogs[$catalog_pointer];

		$data = array();

		foreach ($users as $user_id) 
		{
			$item = ReportData::RSgetCatalogAvg($cat_id, $user_id['id']);
			$data[] = array('name' => $user_id['u_name'], 'cat_title' => $item['catalog'], 'grade' => $item['average']);
		}

		if($append)
			$this->getResponse()->appendBody(Zend_Json::encode($data));

		return array('data' => $data, 'last_catalog' => count($catalogs));

	}

	/*
	 * updatesusercourseAction
	 * Updates the barchart for courses taken by the current user in the view
	 * @param int group_id
	 * @return array containing the data for the barchart, pointer for the current user along with his/her details and limit for the buttons in the view
	 */
	public function updateusercourseAction($group_id, $append = true)
	{
		require_once Zend_Registry::get('appPath'). '/reports/models/ReportData.php';

		$group_id = $this->getRequest()->getParam('gid');
		
		$users = $this->getGroupUserIDs($group_id);
		$courses = $this->getGroupCourseIDs($group_id);

		if (!($this->groupExists($group_id)))
			throw new Zend_Exception(print_r("The group selected does not exist!", true));
		else if ($users == null)
			throw new Zend_Exception(print_r("There are no users in this group.", true));
		else if ($courses == null)
			throw new Zend_Exception(print_r("There are no courses assigned to the group.", true));

		if ($append)
			$user_pointer = $this->getRequest()->getParam('upointer');
		else
			$user_pointer = 0;

		$user_id = $users[$user_pointer]['id'];
		$u_name = $users[$user_pointer]['u_name'];
		$username = $users[$user_pointer]['username'];

		$data = array();
		
		foreach($courses as $course_id)
		{
			$item = ReportData::RSgetCourseAverage($course_id['id'], $user_id);
			$data[] = array('id' => $course_id['id'], 'version' => $course_id['version'], 'title' => $item['title'], 'grade' => $item['average'], 'u_name' => $u_name, 'username' => $username);			
		}

		if ($append)
			$this->getResponse()->appendBody(Zend_Json::encode($data));

		return array('data' => $data, 'current_pointer' => $user_pointer, 'u_name' => $u_name, 'username' => $username, 'last_user' => count($users));
	}

	/*
	 * updatesusercatalogAction
	 * Updates the barchart for catalogs taken by the current user in the view
	 * @param int group_id
	 * @return array containing the data for the barchart, pointer for the current user along with his/her details and limit for the buttons in the view
	 */
	public function updateusercatalogAction($group_id, $append = true)
	{
		require_once Zend_Registry::get('appPath'). '/reports/models/ReportData.php';

		$group_id = $this->getRequest()->getParam('gid');

		$users = $this->getGroupUserIDs($group_id);
		$catalogs = $this->getGroupCatalogIDs($group_id);

		if (!($this->groupExists($group_id)))
			throw new Zend_Exception(print_r("The group selected does not exist!", true));
		else if ($users == null)
			throw new Zend_Exception(print_r("There are no users in this group.", true));
		else if ($catalogs == null)
			throw new Zend_Exception(print_r("There are no catalogs assigned to the group.", true));

		if ($append)
			$user_pointer = $this->getRequest()->getParam('upointer');
		else
			$user_pointer = 0;

		$user_id = $users[$user_pointer]['id'];
		$u_name = $users[$user_pointer]['u_name'];
		$username = $users[$user_pointer]['username'];

		$data = array();

		foreach ($catalogs as $catalog_id)
		{
			$item = ReportData::RSgetCatalogAvg($catalog_id, $user_id);
			$data[] = array('id' => $catalog_id, 'cat_title' => $item['catalog'], 'grade' => $item['average'], 'u_name' => $u_name, 'username' => $username);
		}

		if ($append)
			$this->getResponse()->appendBody(Zend_Json::encode($data));

		return array('data' => $data, 'u_pointer' => $user_pointer, 'u_name' => $u_name, 'username' => $username, 'last_user' => count($users));
	}

	/*
	 * getGroupCourseIDs
	 * Gets all the courses assigned to the group
	 * @param int group_id
	 * @return array containing the course id's for each course assigned to the group 
	 */
	private function getGroupCourseIDs($group_id)
	{
		//get courses based off the list of groups
		$db = Zend_Registry::get('db');
		$dp = new DataParser(true);
		$ids = $dp->getGroupCourseListArray($group_id);
		
		if(count($ids) <= 0)
			return array();

		$sql = $db->select()->from("course", array("id"))->where("course.id in (?)", $ids)->order("course.title ASC");
		$data = $db->fetchAll($sql);
			
		$return = array();
		foreach($data as $row)
		{	
			$sql_version = "Select version from course where id = ?";
			$version = $db->fetchRow($sql_version, $row->id);
			$return[] = array('id' => $row->id, 'version' => $version->version);
		}

		//throw new Zend_Exception(print_r($return, true));

		return $return;
	
	}	

	/*
	 * getGroupUserIDs
	 * Gets all the users assigned to the group
	 * @param int group_id
	 * @return array containing the user id's for each user assigned to the group 
	 */
	private function getGroupUserIDs($group_id)
	{
		$db = Zend_Registry::get('db');
		$sql_users = "Select user_id from group_has_user where groups_id = ?";
		$data = $db->fetchAll($db->quoteInto($sql_users, $group_id));

		$ret = array();
		foreach ($data as $row)
		{
			if ($row->user_id > 0)
			{
				$sql_detail = "Select name, username from users where id = ?";
				$data_user = $db->fetchRow($db->quoteInto($sql_detail, $row->user_id));
				$ret[] = array('id' => $row->user_id, 'u_name' => $data_user->name, 'username' => $data_user->username);
			}
		}		

		return $ret;
	}

	/*
	 * getGroupCatalogIDs
	 * Gets all the catalogs assigned to the group
	 * @param int group_id
	 * @return array containing the catalog id's for each catalog assigned to the group 
	 */
	private function getGroupCatalogIDs($group_id)
	{
		$db = Zend_Registry::get('db');
		$sql_catalogs = "Select catalog_id from group_has_catalog where group_id = ?";
		$data = $db->fetchAll($db->quoteInto($sql_catalogs, $group_id));

		$ret = array();

		foreach ($data as $row) {
			$ret[] = $row->catalog_id;
		}

		return $ret;
	}

	/*
	 * getGroups
	 * Gets all the groups in the domain
	 * @return array containing the group id's and names in the domain
	 */
	private function getGroups()
	{
		$db = Zend_Registry::get('db');
		$sql_groups = "Select id, name from groups";
		$data = $db->fetchAll($db->quoteInto($sql_groups));

		return $data;
	}

	private function groupExists($group_id)
	{
		$db = Zend_Registry::get('db');
		$sql_groups = "Select id, name from groups";
		$data = $db->fetchAll($db->quoteInto($sql_groups));
	
		foreach ($data as $row)
		{	
			if ($row->id == $group_id)
				return true;
		}

		return false;		
	}

	/*
	 * getProgress
	 * Gets the progress of the user for a course
	 * @param array course
	 * @return int progress
	 */
	private function getProgress($course)
	{

		$progress = 0;
		$count = array();

		foreach($course as $course_detail)
		{
			$lesson_progress = 0;
			$do_not_count_lesson = 0;

			foreach($course_detail['grades'] as $lessons)
			{	
				$lesson_has_no_grades = true;
				$sco_progress = 0;
				$do_not_count_sco = 0;

				foreach ($lessons['grades'] as $sco)
				{		
					if ($sco['status'] == "Not Attempted")
					{
						$sco_progress += 0;
						$do_not_count_sco++;
					} 
					else if ($sco['status'] == "Incomplete")
						$sco_progress += 50;
					else if ($sco['status'] == "Completed")
						$sco_progress += 100;
					else if ($sco['status'] == "Passed")
						$sco_progress += 100;
					else if ($sco['status'] == "Failed")
						$sco_progress += 100;
						
					$lesson_has_no_grades = false;
				}
				
				if (!$lesson_has_no_grades)
				{
					$lesson_progress += round($sco_progress / (count($lessons['grades']) - $do_not_count_sco), 1);
				}
				else 
				{
					if ($lessons['status'] == "Completed")
						$lesson_progress += 100;
					else if ($lessons['status'] == "Incomplete")
						$lesson_progress += 50;
					else if ($lessons['status'] == "Not Attempted")
					{
						$lesson_progress += 0;
						$do_not_count_lesson++;
					}
				}
				
				$count[$lessons['title']] = $lesson_progress;

			}

			$progress += round($lesson_progress / (count($course_detail['grades']) - $do_not_count_lesson), 1);

		}

		return array('progress' => $progress, 'count' => $count);

	}

	/*
	 * getProgresswithWeights
	 * Gets the progress of a user for a course and accounts for the sco/lesson weights
	 * @param array course
	 * @return int progress
	 */
	public function getProgresswithWeights($course)
	{
		$progress = 0;

		foreach ($course as $course_detail)
		{
			$lessons_progress = 0;
			$lessons_weight = 0;

			foreach ($course_detail['grades'] as $lessons) 
			{
				
				$skiplessonweight = false;
				$lesson_has_no_grades = true;

				$scos_progress = 0;
				$scos_weight = 0;

				foreach ($lessons['grades'] as $sco)
				{
					
					$skipscoweight = false;

					if ($sco['status'] == "Not Attempted")
					{
						$scos_progress += 0 * $sco['weight'];
						$skipweight = true;
					} 
					else if ($sco['status'] == "Incomplete")
						$scos_progress += 50 * $sco['weight'];
					else if ($sco['status'] == "Completed")
						$scos_progress += 100 * $sco['weight'];
					else if ($sco['status'] == "Passed")
						$scos_progress += 100 * $sco['weight'];
					else if ($sco['status'] == "Failed")
						$scos_progress += 100 * $sco['weight'];

					if (!$skipscoweight)
						$scos_weight += $sco['weight'];
					
					$lesson_has_no_grades = false;

				}

				if (!$lesson_has_no_grades)
				{
					$lessons_progress += round(($scos_progress / $scos_weight), 1);
					$lessons_weight += 1;
				}
				else 
				{
					if ($lessons['status'] == "Completed")
						$lessons_progress += 100 * $lessons['weight'];
					else if ($lessons['status'] == "Incomplete")
						$lessons_progress += 50 * $lessons['weight'];
					else if ($lessons['status'] == "Not Attempted")
					{
						$lessons_progress += 0 * $lessons['weight'];
						$skiplessonweight = true;
					}

					if (!$skiplessonweight)
						$lessons_weight += $lessons['weight'];

				}

				$count[$lessons['title']] = $lessons_progress;

			}

			$progress += round(($lessons_progress / $lessons_weight), 1);

		}

		return array('progress' => $progress, 'count' => $count);
	}

	private function getPassingGrade()
	{
		$db = Zend_Registry::get('db');
		$sql_passing_grade = "Select value from config where param = ?";
		$passing_grade = $db->fetchRow($db->quoteInto($sql_passing_grade, 'passing_grade'));

		return $passing_grade;
	}

}