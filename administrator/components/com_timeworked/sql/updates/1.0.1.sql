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

-- rename field for ticket numbers
ALTER TABLE  `#__tw_work_log` CHANGE  `taskid`  `ticket_numbers` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
-- add a new field for relation with tasks table
ALTER TABLE  `#__tw_work_log` ADD  `taskid` INT UNSIGNED NOT NULL AFTER  `task`;
