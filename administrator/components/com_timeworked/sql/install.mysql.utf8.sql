# GiantLeapLab
# Copyright (C) 2014
# ;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `timeworked`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__tw_clients`
--

CREATE TABLE IF NOT EXISTS `#__tw_clients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company` varchar(255) NOT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `published` tinyint(1) unsigned NOT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `notes` varchar(1000) DEFAULT NULL,
  `set_background_color` tinyint(1) DEFAULT NULL,
  `color` varchar(7) DEFAULT NULL,
  `issue_tracker` varchar(255) NOT NULL DEFAULT '',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__tw_leaves`
--

CREATE TABLE IF NOT EXISTS `#__tw_leaves` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `work_days` smallint(5) unsigned NOT NULL,
  `leave_type` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_commentary` varchar(1000) DEFAULT NULL,
  `admin_commentary` varchar(1000) DEFAULT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `#__tw_leaves_start_date_idx` (`start_date`),
  KEY `#__tw_leaves_end_date_idx` (`end_date`),
  KEY `#__tw_leaves_work_days_idx` (`work_days`),
  KEY `#__tw_leaves_leave_type_idx` (`leave_type`),
  KEY `#__tw_leaves_user_id_idx` (`user_id`),
  KEY `#__tw_leaves_created_by_fk_idx` (`created_by`),
  KEY `#__tw_leaves_modified_by_fk_idx` (`modified_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__tw_leave_types`
--

CREATE TABLE IF NOT EXISTS `#__tw_leave_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `#__tw_leave_type_name_idx` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__tw_notifications`
--

CREATE TABLE IF NOT EXISTS `#__tw_notifications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  `in_process` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__tw_projects`
--

CREATE TABLE IF NOT EXISTS `#__tw_projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `clientid` int(11) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `description` text,
  `set_background_color` tinyint(1) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `issue_tracker` varchar(255) NOT NULL DEFAULT '',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_tw_clients` (`clientid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__tw_users_have_projects`
--

CREATE TABLE IF NOT EXISTS `#__tw_users_have_projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `projectid` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_users` (`userid`),
  KEY `idx_tw_projects` (`projectid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__tw_time_worked_type`
--

CREATE TABLE IF NOT EXISTS `#__tw_time_worked_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `short_name` varchar(3) DEFAULT NULL,
  `color` varchar(7) DEFAULT '#ffffff',
  `default` tinyint(1) unsigned NOT NULL,
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__tw_work_log`
--

CREATE TABLE IF NOT EXISTS `#__tw_work_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `projectid` int(11) unsigned NOT NULL,
  `userid` int(11) NOT NULL,
  `date` date NOT NULL,
  `task` varchar(255) NOT NULL,
  `taskid` int(11) unsigned NOT NULL,
  `performed_work` text NOT NULL,
  `ticket_numbers` varchar(255) DEFAULT NULL,
  `time` time NOT NULL,
  `timeworkedid` int(11) unsigned NOT NULL,
  `billable` tinyint(1) NOT NULL DEFAULT '1',
  `rejected` tinyint(1) NOT NULL DEFAULT '0',
  `rejected_comment` varchar(255) DEFAULT NULL,
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_tw_projects_projectid` (`projectid`),
  KEY `idx_tw_projects_userid` (`userid`),
  KEY `idx_tw_projects_billable` (`billable`),
  KEY `idx_tw_projects_rejected` (`rejected`),
  KEY `idx_tw_projects_created` (`created`),
  KEY `idx_tw_projects_modified` (`modified`),
  KEY `fk_tw_work_log_timeworkedtypeid` (`timeworkedid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `#__tw_leaves`
--
ALTER TABLE `#__tw_leaves`
  ADD CONSTRAINT `#__tw_leaves_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `#__users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `#__tw_leaves_leave_type_fk` FOREIGN KEY (`leave_type`) REFERENCES `#__tw_leave_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `#__tw_leaves_modified_by_fk` FOREIGN KEY (`modified_by`) REFERENCES `#__users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `#__tw_leaves_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `#__users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `#__tw_projects`
--
ALTER TABLE `#__tw_projects`
  ADD CONSTRAINT `#__fk_tw_projects_clientid` FOREIGN KEY (`clientid`) REFERENCES `#__tw_clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `#__tw_users_have_projects`
--
ALTER TABLE `#__tw_users_have_projects`
  ADD CONSTRAINT `#__fk_tw_users_have_projects_projectid` FOREIGN KEY (`projectid`) REFERENCES `#__tw_projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `#__fk_tw_users_have_projects_userid` FOREIGN KEY (`userid`) REFERENCES `#__users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `#__tw_work_log`
--
ALTER TABLE `#__tw_work_log`
  ADD CONSTRAINT `#__fk_tw_work_log_projectid` FOREIGN KEY (`projectid`) REFERENCES `#__tw_projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `#__fk_tw_work_log_timeworkedtypeid` FOREIGN KEY (`timeworkedid`) REFERENCES `#__tw_time_worked_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- Default Time Type
INSERT INTO `#__tw_time_worked_type` (`name`, `short_name`, `color`, `default`, `checked_out`, `checked_out_time`) VALUES
('Default', '', '#ffffff', 1, 0, '0000-00-00 00:00:00');


-- V1.1.0

--
-- Table structure for table `#__tw_projects_have_tasks`
--

CREATE TABLE IF NOT EXISTS `#__tw_projects_have_tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `projectid` int(10) unsigned NOT NULL,
  `taskid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `#__fk_tw_projects_have_tasks_taskid` (`taskid`),
  KEY `#__fk_tw_projects_have_tasks_projectid` (`projectid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__tw_tasks`
--

CREATE TABLE IF NOT EXISTS `#__tw_tasks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `task` varchar(255) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Constraints for dumped tables
--

--
-- Constraints for table `#__tw_projects_have_tasks`
--
ALTER TABLE `#__tw_projects_have_tasks`
  ADD CONSTRAINT `#__fk_tw_projects_have_tasks_taskid` FOREIGN KEY (`taskid`) REFERENCES `#__tw_tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `#__fk_tw_projects_have_tasks_projectid` FOREIGN KEY (`projectid`) REFERENCES `#__tw_projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

