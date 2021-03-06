<?php
/**
 * CoreEventLog
 *
 * *
 * @package    Dinkly
 * @subpackage CoreEventLog
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class CoreEventLog extends BaseEventLog
{
	public static function log($db = null, $context_array, $action, $user_id = null)
	{
		if(!$db)
		{
			$db = DinklyDataConnector::fetchDB();
		}

		$event = new EventLog($db);
		$event->setCreatedAt(date('Y-m-d G:i:s'));
		$event->setSessionId(session_id());
		$event->setApp($context_array['current_app_name']);
		$event->setModule($context_array['module']);
		$event->setView($context_array['view']);

		if(isset($context_array['parameters']))
		{
			$event->setParameters(http_build_query($context_array['parameters']));	
		}
		else if(isset($context_array['get_params']))
		{
			$parameters = "GET=" . http_build_query($context_array['get_params']);
			
			if(isset($context_array['post_params']))
			{
				$parameters .= "POST=" . http_build_query($context_array['post_params']);
			}

			$event->setParameters($parameters);
		}

		$event->setAction($action);
		$event->setUserId($user_id);
		$event->save();

		return $event;
	}
}

