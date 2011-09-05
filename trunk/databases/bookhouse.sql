/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.gnu.org/licenses/gpl-2.0.html
 * @author      Goran Sambolic gsambolic@gmail.com
 *
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */ 

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Baza podataka: `---enter_your_database_name_here--`
-- 

-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `bets`
-- 

DROP TABLE IF EXISTS `bets`;
CREATE TABLE IF NOT EXISTS `bets` (
  `bets_id` int(11) unsigned NOT NULL auto_increment,
  `bet_name` varchar(250) NOT NULL,
  `groups_id_FK` int(11) unsigned NOT NULL,
  `add_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `bet_active` datetime NOT NULL,
  PRIMARY KEY  (`bets_id`),
  KEY `Ref_07` (`groups_id_FK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB; (`groups_id_FK`) REFER `nova_kladionic' AUTO_INCREMENT=113 ;

-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `bets_supertoto`
-- 

DROP TABLE IF EXISTS `bets_supertoto`;
CREATE TABLE IF NOT EXISTS `bets_supertoto` (
  `bet_id` int(11) unsigned NOT NULL auto_increment,
  `bet_name` varchar(350) NOT NULL,
  `supertoto_id_FK` int(11) unsigned NOT NULL default '0',
  `event_value_id_FK` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`bet_id`),
  KEY `Ref_47` (`event_value_id_FK`),
  KEY `Ref_46` (`supertoto_id_FK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `bets_type`
-- 

DROP TABLE IF EXISTS `bets_type`;
CREATE TABLE IF NOT EXISTS `bets_type` (
  `bet_types_id` int(11) unsigned NOT NULL auto_increment,
  `event_bets_id_FK` int(11) unsigned NOT NULL default '0',
  `name` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `teams_has_bets_id_FK` int(11) unsigned default NULL,
  PRIMARY KEY  (`bet_types_id`),
  UNIQUE KEY `new_index11` (`event_bets_id_FK`,`name`),
  KEY `Ref_28` (`teams_has_bets_id_FK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB; (`teams_has_bets_id_FK`) REFER `nova_k' AUTO_INCREMENT=24964 ;

-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `bets_type_has_bet_slip`
-- 

DROP TABLE IF EXISTS `bets_type_has_bet_slip`;
CREATE TABLE IF NOT EXISTS `bets_type_has_bet_slip` (
  `bets_type_has_bet_slip_id` int(11) unsigned NOT NULL auto_increment,
  `bet_types_id_FK` int(11) unsigned NOT NULL default '0',
  `ticket_id_FK` int(11) unsigned NOT NULL default '0',
  `odd_value_id_FK` int(11) unsigned NOT NULL default '0',
  `bets_id_FK` int(11) unsigned NOT NULL default '0',
  `bet_system_comb` int(10) unsigned NOT NULL default '1',
  PRIMARY KEY  (`bets_type_has_bet_slip_id`),
  UNIQUE KEY `unike` USING BTREE (`bets_id_FK`,`ticket_id_FK`,`bet_system_comb`),
  KEY `Ref_15` (`ticket_id_FK`),
  KEY `Ref_30` (`odd_value_id_FK`),
  KEY `Ref_14` (`bet_types_id_FK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB; (`bet_types_id_FK`) REFER `nova_kladio' AUTO_INCREMENT=93 ;

-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `bet_slip`
-- 

DROP TABLE IF EXISTS `bet_slip`;
CREATE TABLE IF NOT EXISTS `bet_slip` (
  `ticket_id` int(11) unsigned NOT NULL auto_increment,
  `date_created` datetime NOT NULL,
  `status` tinyint(4) unsigned default NULL,
  `bettype` varchar(20) NOT NULL,
  PRIMARY KEY  (`ticket_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB' AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

-- 
-- Stand-in structure for view `bet_slip_correct`
-- 
CREATE TABLE `bet_slip_correct` (
`bet_types_correct` bigint(21)
,`ticket_id_FK` int(11) unsigned
,`system` int(10) unsigned
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `bet_slip_finished`
-- 
CREATE TABLE `bet_slip_finished` (
`bet_types_finished` bigint(21)
,`ticket_id_FK` int(11) unsigned
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `bet_slip_placed_type`
-- 
CREATE TABLE `bet_slip_placed_type` (
`bet_types_complete` bigint(21)
,`ticket_id_FK` int(11) unsigned
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `bet_slip_system_all`
-- 
CREATE TABLE `bet_slip_system_all` (
`bet_slip_system_all` bigint(21)
,`ticket_id_FK` int(11) unsigned
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `bet_slip_type_view`
-- 
CREATE TABLE `bet_slip_type_view` (
`count` bigint(21)
,`ticket_id_FKBetSlip` int(11) unsigned
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `bet_slip_with_events`
-- 
CREATE TABLE `bet_slip_with_events` (
`ticket_id` int(11) unsigned
,`status` tinyint(4) unsigned
,`event_bets_id` int(11) unsigned
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `bet_types_complete`
-- 
CREATE TABLE `bet_types_complete` (
`bet_types_complete` bigint(21)
,`ticket_id_FK` int(11) unsigned
,`system` int(10) unsigned
);
-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `bookhouse`
-- 

DROP TABLE IF EXISTS `bookhouse`;
CREATE TABLE IF NOT EXISTS `bookhouse` (
  `bookhouse_id` int(11) unsigned NOT NULL auto_increment,
  `house_name` varchar(100) NOT NULL,
  `timezone` varchar(50) default NULL,
  `default_money_value` decimal(11,2) NOT NULL default '0.00',
  `can_user_register` int(11) NOT NULL default '1',
  `active` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`bookhouse_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='popis kladionica, u komercijalnoj verziji ograniciti na jeda' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Stand-in structure for view `cont`
-- 
CREATE TABLE `cont` (
`count` bigint(21)
,`bets_id_FK` int(11) unsigned
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `countfinished`
-- 
CREATE TABLE `countfinished` (
`count` bigint(21)
,`bets_id_FK` int(11) unsigned
);
-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `events_table`
-- 

DROP TABLE IF EXISTS `events_table`;
CREATE TABLE IF NOT EXISTS `events_table` (
  `event_id` int(11) unsigned NOT NULL auto_increment,
  `event_name` varchar(100) NOT NULL,
  `date_created` date NOT NULL,
  `sports_id_FK` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`event_id`),
  UNIQUE KEY `index` (`event_name`,`sports_id_FK`),
  KEY `Ref_42` (`sports_id_FK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB; (`sports_id_FK`) REFER `nova_kladionic' AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `events_table_supertoto`
-- 

DROP TABLE IF EXISTS `events_table_supertoto`;
CREATE TABLE IF NOT EXISTS `events_table_supertoto` (
  `event_id` int(11) unsigned NOT NULL auto_increment,
  `event_name` varchar(100) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY  (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `event_bets`
-- 

DROP TABLE IF EXISTS `event_bets`;
CREATE TABLE IF NOT EXISTS `event_bets` (
  `event_bets_id` int(11) unsigned NOT NULL auto_increment,
  `bets_id_FK` int(11) unsigned NOT NULL default '0',
  `event_id_FK` int(11) unsigned default '0',
  `event_bets_name` varchar(250) NOT NULL,
  `score` varchar(100) default NULL,
  `correctType` int(11) unsigned default NULL,
  PRIMARY KEY  (`event_bets_id`),
  UNIQUE KEY `new_index10` (`bets_id_FK`,`event_id_FK`),
  KEY `Ref_25` (`event_id_FK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB; (`bets_id_FK`) REFER `nova_kladionica/' AUTO_INCREMENT=3286 ;

-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `event_value`
-- 

DROP TABLE IF EXISTS `event_value`;
CREATE TABLE IF NOT EXISTS `event_value` (
  `event_value_id` int(11) unsigned NOT NULL auto_increment,
  `event_id_FK` int(11) unsigned NOT NULL default '0',
  `date_created` date NOT NULL,
  `event_value_name` varchar(100) default NULL,
  PRIMARY KEY  (`event_value_id`),
  UNIQUE KEY `index` (`event_id_FK`,`event_value_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB; (`event_id_FK`) REFER `nova_kladionica' AUTO_INCREMENT=147 ;

-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `event_value_supertoto`
-- 

DROP TABLE IF EXISTS `event_value_supertoto`;
CREATE TABLE IF NOT EXISTS `event_value_supertoto` (
  `event_value_id` int(11) unsigned NOT NULL auto_increment,
  `event_id_FK` int(11) unsigned NOT NULL default '0',
  `date_created` date NOT NULL,
  `event_value_name` varchar(100) default NULL,
  PRIMARY KEY  (`event_value_id`),
  KEY `Ref_44` (`event_id_FK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------
 

-- 
-- Stand-in structure for view `finished_correctview`
-- 
CREATE TABLE `finished_correctview` (
`ticket_id` int(11) unsigned
,`status` tinyint(4) unsigned
,`bet_types_complete` bigint(21)
,`bet_types_correct` bigint(21)
,`system` int(10) unsigned
);
-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `groups`
-- 

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `groups_id` int(11) unsigned NOT NULL auto_increment,
  `name_of_group` varchar(100) NOT NULL,
  `datecreated` date NOT NULL,
  `sports_id_FK` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`groups_id`),
  UNIQUE KEY `group_name` (`name_of_group`,`sports_id_FK`),
  KEY `groups_to_sports` (`sports_id_FK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB; (`sports_id_FK`) REFER `nova_kladionic' AUTO_INCREMENT=26476954 ;

-- --------------------------------------------------------

-- 
-- Stand-in structure for view `latest_odd_value`
-- 
CREATE TABLE `latest_odd_value` (
`odd_value_id` int(11) unsigned
,`odd_value` decimal(4,2)
,`bet_types_id_FK` int(11) unsigned
,`data_created_oddValue` datetime
);
-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `odd_value`
-- 

DROP TABLE IF EXISTS `odd_value`;
CREATE TABLE IF NOT EXISTS `odd_value` (
  `odd_value_id` int(11) unsigned NOT NULL auto_increment,
  `odd_value` decimal(4,2) NOT NULL,
  `bet_types_id_FK` int(11) unsigned NOT NULL default '0',
  `data_created` datetime NOT NULL,
  PRIMARY KEY  (`odd_value_id`),
  KEY `Ref_21` (`bet_types_id_FK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB; (`bet_types_id_FK`) REFER `nova_kladio' AUTO_INCREMENT=24996 ;

-- --------------------------------------------------------

-- 
-- Stand-in structure for view `possible_win`
-- 
CREATE TABLE `possible_win` (
`possible_win` varchar(19)
,`ticket_id` int(11) unsigned
,`status` tinyint(4) unsigned
,`user_id_FK` int(11) unsigned
,`money` decimal(11,2)
,`bet_system_comb` int(10) unsigned
,`bet_types_complete` bigint(21)
,`bet_types_correct` bigint(21)
);
-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `prebuild_groups`
-- 

DROP TABLE IF EXISTS `prebuild_groups`;
CREATE TABLE IF NOT EXISTS `prebuild_groups` (
  `prebuild_groups_id` int(11) unsigned NOT NULL auto_increment,
  `name_of_group` varchar(100) NOT NULL,
  PRIMARY KEY  (`prebuild_groups_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `prebuild_teams`
-- 

DROP TABLE IF EXISTS `prebuild_teams`;
CREATE TABLE IF NOT EXISTS `prebuild_teams` (
  `prebuild_teams_id` int(11) unsigned NOT NULL auto_increment,
  `name_of_team` varchar(250) NOT NULL,
  `prebuild_groups_id_FK` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`prebuild_teams_id`),
  KEY `pre_teams_to_pre_groups` (`prebuild_groups_id_FK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB; (`prebuild_groups_id_FK`) REFER `nova_' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Stand-in structure for view `selectbetevents`
-- 
CREATE TABLE `selectbetevents` (
`betId` int(11) unsigned
,`dateinfo` datetime
,`active` datetime
,`winner` varchar(100)
,`teamId` int(11) unsigned
,`oddname` varchar(100)
,`odd` decimal(4,2)
,`oddid` int(11) unsigned
,`eventname` varchar(250)
,`betTypeId` int(11) unsigned
,`eventId` int(11) unsigned
,`eventbetId` int(11) unsigned
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `select_unfinished_bets`
-- 
CREATE TABLE `select_unfinished_bets` (
`ticket_id` int(11) unsigned
,`date_created` datetime
,`status` tinyint(4) unsigned
,`bet_types_finished` bigint(21)
,`bet_slip_system_all` bigint(21)
);
-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `sports`
-- 

DROP TABLE IF EXISTS `sports`;
CREATE TABLE IF NOT EXISTS `sports` (
  `sports_id` int(11) unsigned NOT NULL auto_increment,
  `name_of_sport` varchar(100) NOT NULL,
  `bookhouse_id_FK` int(11) unsigned NOT NULL,
  `datecreated` date NOT NULL,
  PRIMARY KEY  (`sports_id`),
  UNIQUE KEY `name` (`name_of_sport`,`bookhouse_id_FK`),
  KEY `sports_to_bookhouse` (`bookhouse_id_FK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB; (`bookhouse_id_FK`) REFER `nova_kladio' AUTO_INCREMENT=7523 ;

-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `supertoto`
-- 

DROP TABLE IF EXISTS `supertoto`;
CREATE TABLE IF NOT EXISTS `supertoto` (
  `supertoto_id` int(11) unsigned NOT NULL auto_increment,
  `supertoto_name` varchar(350) default NULL,
  `placepays` smallint(6) unsigned NOT NULL,
  `added` date NOT NULL,
  `finished` datetime NOT NULL,
  `active` datetime NOT NULL,
  `event_id_FK` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`supertoto_id`),
  KEY `Ref_45` (`event_id_FK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `teams`
-- 

DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `teams_id` int(11) unsigned NOT NULL auto_increment,
  `add_date` date NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `groups_id_FK` int(11) unsigned NOT NULL,
  `bet_team_pick_id_FK` int(11) unsigned default NULL,
  PRIMARY KEY  (`teams_id`),
  UNIQUE KEY `unike` (`team_name`,`groups_id_FK`),
  KEY `teams_to_groups` (`groups_id_FK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB; (`groups_id_FK`) REFER `nova_kladionic' AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `teams_has_bets`
-- 

DROP TABLE IF EXISTS `teams_has_bets`;
CREATE TABLE IF NOT EXISTS `teams_has_bets` (
  `teams_has_bets_id` int(11) unsigned NOT NULL auto_increment,
  `teams_id_FK` int(11) unsigned default NULL,
  `bets_id_FK` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`teams_has_bets_id`),
  UNIQUE KEY `unike` (`teams_id_FK`,`bets_id_FK`),
  KEY `Ref_23` (`bets_id_FK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB; (`teams_id_FK`) REFER `nova_kladionica' AUTO_INCREMENT=67 ;

-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `transaction_in`
-- 

DROP TABLE IF EXISTS `transaction_in`;
CREATE TABLE IF NOT EXISTS `transaction_in` (
  `transaction_in_id` int(11) unsigned NOT NULL auto_increment,
  `user_id_FK` int(11) unsigned NOT NULL default '0',
  `money` decimal(11,2) NOT NULL,
  `admin_id_FK_1` int(10) unsigned default '0',
  `ticket_id_FK` int(11) unsigned default '0',
  `date_created` datetime NOT NULL,
  `system` int(10) unsigned default NULL,
  PRIMARY KEY  (`transaction_in_id`),
  KEY `Ref_31` (`user_id_FK`),
  KEY `Ref_33` (`ticket_id_FK`),
  KEY `Ref_32` (`admin_id_FK_1`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB; (`user_id_FK`) REFER `nova_kladionica/' AUTO_INCREMENT=351 ;

-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `transaction_out`
-- 

DROP TABLE IF EXISTS `transaction_out`;
CREATE TABLE IF NOT EXISTS `transaction_out` (
  `transaction_out_id` int(11) unsigned NOT NULL auto_increment,
  `ticket_id_FK` int(11) unsigned default NULL,
  `money` decimal(11,2) NOT NULL,
  `admin_id_FK` int(10) unsigned default NULL,
  `user_id_FK` int(11) unsigned NOT NULL default '0',
  `date_created` datetime NOT NULL,
  PRIMARY KEY  (`transaction_out_id`),
  KEY `Ref_34` (`ticket_id_FK`),
  KEY `Ref_36` (`user_id_FK`),
  KEY `Ref_35` (`admin_id_FK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB; (`ticket_id_FK`) REFER `nova_kladionic' AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `user`
-- 

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) unsigned NOT NULL auto_increment,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `salt` char(9) NOT NULL,
  `user_status_id_FK` tinyint(4) unsigned NOT NULL default '0',
  `mailvalidation` varchar(50) default NULL,
  `secret_que` varchar(50) default NULL,
  `sercret_ans` varchar(50) default NULL,
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `unike` (`user_name`),
  UNIQUE KEY `unikeemail` (`email`),
  KEY `Ref_39` (`user_status_id_FK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB; (`user_status_id_FK`) REFER `nova_klad' AUTO_INCREMENT=56 ;

-- --------------------------------------------------------

-- 
-- Stand-in structure for view `userselectactivegroups`
-- 
CREATE TABLE `userselectactivegroups` (
`groupName` varchar(100)
,`groupsId` int(11) unsigned
,`sportsId` int(11) unsigned
);
-- --------------------------------------------------------

-- 
-- Tablična struktura za tablicu `user_status`
-- 

DROP TABLE IF EXISTS `user_status`;
CREATE TABLE IF NOT EXISTS `user_status` (
  `user_status_id` tinyint(4) unsigned NOT NULL,
  `status_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`user_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 7168 kB';

-- --------------------------------------------------------

-- 
-- Structure for view `bet_slip_correct`
-- 
DROP TABLE IF EXISTS `bet_slip_correct`;

DROP VIEW IF EXISTS `bet_slip_correct`;
CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `---enter_your_database_name_here--`.`bet_slip_correct` AS select count(0) AS `bet_types_correct`,`b`.`ticket_id_FK` AS `ticket_id_FK`,`b`.`bet_system_comb` AS `system` from ((`---enter_your_database_name_here--`.`bets_type_has_bet_slip` `b` left join `---enter_your_database_name_here--`.`bets_type` `bt` on((`bt`.`bet_types_id` = `b`.`bet_types_id_FK`))) join `---enter_your_database_name_here--`.`event_bets` `eb` on(((`bt`.`event_bets_id_FK` = `eb`.`event_bets_id`) and (`eb`.`correctType` = `bt`.`bet_types_id`)))) group by `b`.`ticket_id_FK`,`b`.`bet_system_comb`;

-- --------------------------------------------------------

-- 
-- Structure for view `bet_slip_finished`
-- 
DROP TABLE IF EXISTS `bet_slip_finished`;

DROP VIEW IF EXISTS `bet_slip_finished`;
CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `---enter_your_database_name_here--`.`bet_slip_finished` AS select count(distinct `b`.`bets_id_FK`) AS `bet_types_finished`,`b`.`ticket_id_FK` AS `ticket_id_FK` from ((`---enter_your_database_name_here--`.`bets_type_has_bet_slip` `b` left join `---enter_your_database_name_here--`.`bets_type` `bt` on((`bt`.`bet_types_id` = `b`.`bet_types_id_FK`))) join `---enter_your_database_name_here--`.`event_bets` `eb` on(((`bt`.`event_bets_id_FK` = `eb`.`event_bets_id`) and (`eb`.`correctType` > 0)))) group by `b`.`ticket_id_FK`;

-- --------------------------------------------------------

-- 
-- Structure for view `bet_slip_placed_type`
-- 
DROP TABLE IF EXISTS `bet_slip_placed_type`;

DROP VIEW IF EXISTS `bet_slip_placed_type`;
CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `---enter_your_database_name_here--`.`bet_slip_placed_type` AS select count(0) AS `bet_types_complete`,`b`.`ticket_id_FK` AS `ticket_id_FK` from `---enter_your_database_name_here--`.`bets_type_has_bet_slip` `b` group by `b`.`ticket_id_FK`;

-- --------------------------------------------------------

-- 
-- Structure for view `bet_slip_system_all`
-- 
DROP TABLE IF EXISTS `bet_slip_system_all`;

DROP VIEW IF EXISTS `bet_slip_system_all`;
CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `---enter_your_database_name_here--`.`bet_slip_system_all` AS select count(distinct `b`.`bets_id_FK`) AS `bet_slip_system_all`,`b`.`ticket_id_FK` AS `ticket_id_FK` from ((`---enter_your_database_name_here--`.`bets_type_has_bet_slip` `b` join `---enter_your_database_name_here--`.`bets_type` `bt` on((`bt`.`bet_types_id` = `b`.`bet_types_id_FK`))) join `---enter_your_database_name_here--`.`event_bets` `eb` on(((`bt`.`event_bets_id_FK` = `eb`.`event_bets_id`) and ((`eb`.`correctType` <> 0) or isnull(`eb`.`correctType`))))) group by `b`.`ticket_id_FK`;

-- --------------------------------------------------------

-- 
-- Structure for view `bet_slip_type_view`
-- 
DROP TABLE IF EXISTS `bet_slip_type_view`;

DROP VIEW IF EXISTS `bet_slip_type_view`;
CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `---enter_your_database_name_here--`.`bet_slip_type_view` AS select count(0) AS `count`,`b`.`ticket_id_FK` AS `ticket_id_FKBetSlip` from `---enter_your_database_name_here--`.`bets_type_has_bet_slip` `b` group by `b`.`ticket_id_FK`;

-- --------------------------------------------------------

-- 
-- Structure for view `bet_slip_with_events`
-- 
DROP TABLE IF EXISTS `bet_slip_with_events`;

DROP VIEW IF EXISTS `bet_slip_with_events`;
CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `---enter_your_database_name_here--`.`bet_slip_with_events` AS select `b`.`ticket_id` AS `ticket_id`,`b`.`status` AS `status`,`eb`.`event_bets_id` AS `event_bets_id` from (((`---enter_your_database_name_here--`.`bet_slip` `b` join `---enter_your_database_name_here--`.`bets_type_has_bet_slip` `bth` on((`bth`.`ticket_id_FK` = `b`.`ticket_id`))) left join `---enter_your_database_name_here--`.`bets_type` `bt` on((`bth`.`bet_types_id_FK` = `bt`.`bet_types_id`))) left join `---enter_your_database_name_here--`.`event_bets` `eb` on((`eb`.`event_bets_id` = `bt`.`event_bets_id_FK`)));

-- --------------------------------------------------------

-- 
-- Structure for view `bet_types_complete`
-- 
DROP TABLE IF EXISTS `bet_types_complete`;

DROP VIEW IF EXISTS `bet_types_complete`;
CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `---enter_your_database_name_here--`.`bet_types_complete` AS select count(0) AS `bet_types_complete`,`b`.`ticket_id_FK` AS `ticket_id_FK`,`b`.`bet_system_comb` AS `system` from ((`---enter_your_database_name_here--`.`bets_type_has_bet_slip` `b` left join `---enter_your_database_name_here--`.`bets_type` `bt` on((`bt`.`bet_types_id` = `b`.`bet_types_id_FK`))) join `---enter_your_database_name_here--`.`event_bets` `eb` on(((`bt`.`event_bets_id_FK` = `eb`.`event_bets_id`) and ((`eb`.`correctType` <> 0) or isnull(`eb`.`correctType`))))) group by `b`.`ticket_id_FK`,`b`.`bet_system_comb`;

-- --------------------------------------------------------

-- 
-- Structure for view `cont`
-- 
DROP TABLE IF EXISTS `cont`;

DROP VIEW IF EXISTS `cont`;
CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `---enter_your_database_name_here--`.`cont` AS select count(0) AS `count`,`---enter_your_database_name_here--`.`event_bets`.`bets_id_FK` AS `bets_id_FK` from `---enter_your_database_name_here--`.`event_bets` group by `---enter_your_database_name_here--`.`event_bets`.`bets_id_FK`;

-- --------------------------------------------------------

-- 
-- Structure for view `countfinished`
-- 
DROP TABLE IF EXISTS `countfinished`;

DROP VIEW IF EXISTS `countfinished`;
CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `---enter_your_database_name_here--`.`countfinished` AS select count(0) AS `count`,`---enter_your_database_name_here--`.`event_bets`.`bets_id_FK` AS `bets_id_FK` from `---enter_your_database_name_here--`.`event_bets` where isnull(`---enter_your_database_name_here--`.`event_bets`.`correctType`) group by `---enter_your_database_name_here--`.`event_bets`.`bets_id_FK`;

-- --------------------------------------------------------

-- 
-- Structure for view `finished_correctview`
-- 
DROP TABLE IF EXISTS `finished_correctview`;

DROP VIEW IF EXISTS `finished_correctview`;
CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `---enter_your_database_name_here--`.`finished_correctview` AS select `b`.`ticket_id` AS `ticket_id`,`b`.`status` AS `status`,`btc`.`bet_types_complete` AS `bet_types_complete`,`bsc`.`bet_types_correct` AS `bet_types_correct`,`btc`.`system` AS `system` from ((`---enter_your_database_name_here--`.`bet_slip` `b` left join `---enter_your_database_name_here--`.`bet_types_complete` `btc` on((`b`.`ticket_id` = `btc`.`ticket_id_FK`))) left join `---enter_your_database_name_here--`.`bet_slip_correct` `bsc` on(((`b`.`ticket_id` = `bsc`.`ticket_id_FK`) and (`bsc`.`system` = `btc`.`system`)))) where (`b`.`status` = 1);

-- --------------------------------------------------------

-- 
-- Structure for view `latest_odd_value`
-- 
DROP TABLE IF EXISTS `latest_odd_value`;

DROP VIEW IF EXISTS `latest_odd_value`;
CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `---enter_your_database_name_here--`.`latest_odd_value` AS select `---enter_your_database_name_here--`.`odd_value`.`odd_value_id` AS `odd_value_id`,`---enter_your_database_name_here--`.`odd_value`.`odd_value` AS `odd_value`,`---enter_your_database_name_here--`.`odd_value`.`bet_types_id_FK` AS `bet_types_id_FK`,`---enter_your_database_name_here--`.`odd_value`.`data_created` AS `data_created_oddValue` from `---enter_your_database_name_here--`.`odd_value` group by `---enter_your_database_name_here--`.`odd_value`.`bet_types_id_FK` desc;

-- --------------------------------------------------------

-- 
-- Structure for view `possible_win`
-- 
DROP TABLE IF EXISTS `possible_win`;

DROP VIEW IF EXISTS `possible_win`;
CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `---enter_your_database_name_here--`.`possible_win` AS select format((exp(sum(log(coalesce(`od`.`odd_value`,1)))) * `to`.`money`),2) AS `possible_win`,`bs`.`ticket_id` AS `ticket_id`,`bs`.`status` AS `status`,`to`.`user_id_FK` AS `user_id_FK`,`to`.`money` AS `money`,`bt`.`bet_system_comb` AS `bet_system_comb`,`btc`.`bet_types_complete` AS `bet_types_complete`,`btc`.`bet_types_correct` AS `bet_types_correct` from ((((`---enter_your_database_name_here--`.`bets_type_has_bet_slip` `bt` left join `---enter_your_database_name_here--`.`odd_value` `od` on((`od`.`odd_value_id` = `bt`.`odd_value_id_FK`))) left join `---enter_your_database_name_here--`.`bet_slip` `bs` on((`bs`.`ticket_id` = `bt`.`ticket_id_FK`))) left join `---enter_your_database_name_here--`.`transaction_out` `to` on((`bs`.`ticket_id` = `to`.`ticket_id_FK`))) left join `---enter_your_database_name_here--`.`finished_correctview` `btc` on(((`bs`.`ticket_id` = `btc`.`ticket_id`) and (`btc`.`system` = `bt`.`bet_system_comb`)))) where (`bs`.`status` = 1) group by `bt`.`ticket_id_FK`,`bt`.`bet_system_comb`;

-- --------------------------------------------------------

-- 
-- Structure for view `selectbetevents`
-- 
DROP TABLE IF EXISTS `selectbetevents`;

DROP VIEW IF EXISTS `selectbetevents`;
CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `---enter_your_database_name_here--`.`selectbetevents` AS select `b`.`bets_id` AS `betId`,`b`.`end_date` AS `dateinfo`,`b`.`bet_active` AS `active`,`t`.`team_name` AS `winner`,`bt`.`teams_has_bets_id_FK` AS `teamId`,`bt`.`name` AS `oddname`,`od`.`odd_value` AS `odd`,`od`.`odd_value_id` AS `oddid`,`eb`.`event_bets_name` AS `eventname`,`bt`.`bet_types_id` AS `betTypeId`,`e`.`event_id` AS `eventId`,`eb`.`event_bets_id` AS `eventbetId` from ((((((`---enter_your_database_name_here--`.`bets` `b` join `---enter_your_database_name_here--`.`event_bets` `eb` on((`b`.`bets_id` = `eb`.`bets_id_FK`))) join `---enter_your_database_name_here--`.`bets_type` `bt` on((`eb`.`event_bets_id` = `bt`.`event_bets_id_FK`))) join `---enter_your_database_name_here--`.`events_table` `e` on((`eb`.`event_id_FK` = `e`.`event_id`))) join `---enter_your_database_name_here--`.`odd_value` `od` on((`od`.`bet_types_id_FK` = `bt`.`bet_types_id`))) left join `---enter_your_database_name_here--`.`teams_has_bets` `tb` on((`tb`.`teams_has_bets_id` = `bt`.`teams_has_bets_id_FK`))) left join `---enter_your_database_name_here--`.`teams` `t` on((`tb`.`teams_id_FK` = `t`.`teams_id`)));

-- --------------------------------------------------------

-- 
-- Structure for view `select_unfinished_bets`
-- 
DROP TABLE IF EXISTS `select_unfinished_bets`;

DROP VIEW IF EXISTS `select_unfinished_bets`;
CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `---enter_your_database_name_here--`.`select_unfinished_bets` AS select `b`.`ticket_id` AS `ticket_id`,`b`.`date_created` AS `date_created`,`b`.`status` AS `status`,`bsf`.`bet_types_finished` AS `bet_types_finished`,`bssa`.`bet_slip_system_all` AS `bet_slip_system_all` from ((`---enter_your_database_name_here--`.`bet_slip` `b` left join `---enter_your_database_name_here--`.`bet_slip_finished` `bsf` on((`b`.`ticket_id` = `bsf`.`ticket_id_FK`))) left join `---enter_your_database_name_here--`.`bet_slip_system_all` `bssa` on((`b`.`ticket_id` = `bssa`.`ticket_id_FK`))) where isnull(`b`.`status`);

-- --------------------------------------------------------

-- 
-- Structure for view `userselectactivegroups`
-- 
DROP TABLE IF EXISTS `userselectactivegroups`;

DROP VIEW IF EXISTS `userselectactivegroups`;
CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `---enter_your_database_name_here--`.`userselectactivegroups` AS select `g`.`name_of_group` AS `groupName`,`g`.`groups_id` AS `groupsId`,`g`.`sports_id_FK` AS `sportsId` from (`---enter_your_database_name_here--`.`bets` `b` left join `---enter_your_database_name_here--`.`groups` `g` on((`g`.`groups_id` = `b`.`groups_id_FK`))) where ((`b`.`end_date` > now()) and (`b`.`bet_active` < now())) group by `b`.`groups_id_FK`;

-- 
-- Ograničenja za izbačene tablice
-- 

-- 
-- Ograničenja za tablicu `bets`
-- 
ALTER TABLE `bets`
  ADD CONSTRAINT `Ref_07` FOREIGN KEY (`groups_id_FK`) REFERENCES `groups` (`groups_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Ograničenja za tablicu `bets_supertoto`
-- 
ALTER TABLE `bets_supertoto`
  ADD CONSTRAINT `Ref_46` FOREIGN KEY (`supertoto_id_FK`) REFERENCES `supertoto` (`supertoto_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ref_47` FOREIGN KEY (`event_value_id_FK`) REFERENCES `event_value_supertoto` (`event_value_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Ograničenja za tablicu `bets_type`
-- 
ALTER TABLE `bets_type`
  ADD CONSTRAINT `Ref_28` FOREIGN KEY (`teams_has_bets_id_FK`) REFERENCES `teams_has_bets` (`teams_has_bets_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Ref_29` FOREIGN KEY (`event_bets_id_FK`) REFERENCES `event_bets` (`event_bets_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Ograničenja za tablicu `bets_type_has_bet_slip`
-- 
ALTER TABLE `bets_type_has_bet_slip`
  ADD CONSTRAINT `Ref_14` FOREIGN KEY (`bet_types_id_FK`) REFERENCES `bets_type` (`bet_types_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ref_15` FOREIGN KEY (`ticket_id_FK`) REFERENCES `bet_slip` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ref_30` FOREIGN KEY (`odd_value_id_FK`) REFERENCES `odd_value` (`odd_value_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ref_38` FOREIGN KEY (`bets_id_FK`) REFERENCES `bets` (`bets_id`) ON UPDATE CASCADE;

-- 
-- Ograničenja za tablicu `events_table`
-- 
ALTER TABLE `events_table`
  ADD CONSTRAINT `Ref_42` FOREIGN KEY (`sports_id_FK`) REFERENCES `sports` (`sports_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Ograničenja za tablicu `event_bets`
-- 
ALTER TABLE `event_bets`
  ADD CONSTRAINT `Ref_24` FOREIGN KEY (`bets_id_FK`) REFERENCES `bets` (`bets_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ref_25` FOREIGN KEY (`event_id_FK`) REFERENCES `events_table` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Ograničenja za tablicu `event_value`
-- 
ALTER TABLE `event_value`
  ADD CONSTRAINT `event_value_to_events` FOREIGN KEY (`event_id_FK`) REFERENCES `events_table` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Ograničenja za tablicu `event_value_supertoto`
-- 
ALTER TABLE `event_value_supertoto`
  ADD CONSTRAINT `Ref_44` FOREIGN KEY (`event_id_FK`) REFERENCES `events_table_supertoto` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Ograničenja za tablicu `groups`
-- 
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_to_sports` FOREIGN KEY (`sports_id_FK`) REFERENCES `sports` (`sports_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Ograničenja za tablicu `odd_value`
-- 
ALTER TABLE `odd_value`
  ADD CONSTRAINT `Ref_21` FOREIGN KEY (`bet_types_id_FK`) REFERENCES `bets_type` (`bet_types_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Ograničenja za tablicu `prebuild_teams`
-- 
ALTER TABLE `prebuild_teams`
  ADD CONSTRAINT `pre_teams_to_pre_groups` FOREIGN KEY (`prebuild_groups_id_FK`) REFERENCES `prebuild_groups` (`prebuild_groups_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Ograničenja za tablicu `sports`
-- 
ALTER TABLE `sports`
  ADD CONSTRAINT `sports_to_bookhouse` FOREIGN KEY (`bookhouse_id_FK`) REFERENCES `bookhouse` (`bookhouse_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Ograničenja za tablicu `supertoto`
-- 
ALTER TABLE `supertoto`
  ADD CONSTRAINT `Ref_45` FOREIGN KEY (`event_id_FK`) REFERENCES `events_table_supertoto` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Ograničenja za tablicu `teams`
-- 
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_to_groups` FOREIGN KEY (`groups_id_FK`) REFERENCES `groups` (`groups_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Ograničenja za tablicu `teams_has_bets`
-- 
ALTER TABLE `teams_has_bets`
  ADD CONSTRAINT `Ref_22` FOREIGN KEY (`teams_id_FK`) REFERENCES `teams` (`teams_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ref_23` FOREIGN KEY (`bets_id_FK`) REFERENCES `bets` (`bets_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Ograničenja za tablicu `transaction_in`
-- 
ALTER TABLE `transaction_in`
  ADD CONSTRAINT `Ref_31` FOREIGN KEY (`user_id_FK`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ref_32` FOREIGN KEY (`admin_id_FK_1`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ref_33` FOREIGN KEY (`ticket_id_FK`) REFERENCES `bet_slip` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Ograničenja za tablicu `transaction_out`
-- 
ALTER TABLE `transaction_out`
  ADD CONSTRAINT `Ref_34` FOREIGN KEY (`ticket_id_FK`) REFERENCES `bet_slip` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ref_35` FOREIGN KEY (`admin_id_FK`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ref_36` FOREIGN KEY (`user_id_FK`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Ograničenja za tablicu `user`
-- 
ALTER TABLE `user`
  ADD CONSTRAINT `Ref_39` FOREIGN KEY (`user_status_id_FK`) REFERENCES `user_status` (`user_status_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Postupci
-- 
DELIMITER $$
-- 
CREATE  PROCEDURE `canUserRegister`()
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  select   can_user_register from bookhouse where bookhouse_id=1;
END$$

CREATE  PROCEDURE `colavg`(IN `tbl` CHAR(64), IN `col` CHAR(64), IN `prim` int(11) unsigned )
    READS SQL DATA
    DETERMINISTIC
    COMMENT 'Selects the average of column col in table tbl'
BEGIN
  set @a=prim;
  SET @s = CONCAT('select * from ',tbl,' where ',col,'=?');
  PREPARE stmt FROM @s;
  EXECUTE stmt using @a;
END$$

CREATE  PROCEDURE `defaultMoney`()
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  select  default_money_value  from bookhouse where bookhouse_id=1;
END$$

CREATE  PROCEDURE `deleteActiveBet`(IN `primParam` int(11) unsigned , IN `timeParam` datetime, IN `statusParam` varchar(10))
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  CASE statusParam

         WHEN  "arhive" then
             update event_bets eb set eb.score="--", eb.correctType='0' where eb.bets_id_FK=( select bets_id from bets where bet_active<timeParam and  timeParam< end_date and bets_id=primParam limit 1) and  eb.correctType is null ;
              update bets b set b.end_date=timeParam  where b.bets_id=primParam and timeParam<b.end_date and  timeParam>b.bet_active;


         WHEN  "finished" then
            update bets b set b.end_date=timeParam  where b.bets_id=primParam and timeParam<b.end_date and  timeParam>b.bet_active;


   WHEN  "fintoarh" then
          update event_bets eb set eb.score="--", eb.correctType='0' where eb.bets_id_FK=( select bets_id from bets where   timeParam> end_date and bets_id=primParam limit 1) and  eb.correctType is null ;

      END CASE;
END$$

CREATE  PROCEDURE `deleteActiveEvent`(IN `primParam` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare betId int(11) unsigned ;

          select bets_id into betId  from bets b where b.bets_id=(select bets_id_FK from event_bets where event_bets_id=primParam limit 1 ) and b.bet_active<timeParam  limit 1;
          update event_bets  set score="--", correctType="0" where bets_id_FK=betId and event_bets_id=primParam   and  correctType is null limit 1;
END$$

CREATE  PROCEDURE `deleteBet`(IN `primParam` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  delete from bets where bets_id=primParam and timeParam<bet_active;
END$$

CREATE  PROCEDURE `deleteBetTeams`(IN `primBet` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  DECLARE dateFrombet datetime;
        DECLARE primEvent int(11) unsigned ;

        select  bets_id_FK into primEvent  from teams_has_bets where teams_has_bets_id=primBet;
        select  bet_active into dateFrombet from bets where bets_id=primEvent;

        IF  timeParam < dateFrombet  THEN
                delete from teams_has_bets where teams_has_bets_id=primBet limit 1;
                call selectEventBetTeams(primEvent);

        END IF;
END$$

CREATE  PROCEDURE `deleteBetType`(IN `idParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare bet_id_FKVariable int;
    select bets_id_FK into bet_id_FKVariable from bets_type where bet_types_id=idParam  limit 1;
    delete from bets_type where bet_types_id=idParam limit 1;
    call selectBetsType(bet_id_FKVariable) ;
END$$

CREATE  PROCEDURE `deleteEventBets`(IN `primParam` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare bet_data_active datetime;

        select bet_active into bet_data_active from bets b where b.bets_id=(select bets_id_FK from event_bets where event_bets_id=primParam   limit 1 ) limit 1;

       if bet_data_active>timeParam then

        delete from event_bets where event_bets_id=primParam limit 1;

      end if;
END$$

CREATE  PROCEDURE `deleteEvents`(IN `dataIdParam` int(11) unsigned , IN `sportIdParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  delete from events_table where event_id=dataIdParam limit 1;
    call selectEvents( sportIdParam );
END$$

CREATE  PROCEDURE `deleteEventsSupertoto`(IN `dataIdParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
    delete from events_table_supertoto where event_id=dataIdParam limit 1;
    call selectEventsSupertoto();
END$$

CREATE  PROCEDURE `deleteEventType`(IN `dataIdParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare event_id_FKVariable int;
  select event_id_FK into event_id_FKVariable from event_value where event_value_id=dataIdParam limit 1;
  delete from event_value where event_value_id=dataIdParam limit 1;
  Select event_value_id as eventValueId,   event_value_name as name from event_value where event_id_FK=event_id_FKVariable order by event_value_id;
END$$

CREATE  PROCEDURE `deleteEventTypeSupertoto`(IN `dataIdParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare event_id_FKVariable int;
  select event_id_FK into event_id_FKVariable from event_value_supertoto where event_value_id=dataIdParam limit 1;
  delete from event_value_supertoto where event_value_id=dataIdParam limit 1;
  Select event_value_id as eventValueId,   event_value_name as name from event_value_supertoto where event_id_FK=event_id_FKVariable order by event_value_id;
END$$

CREATE  PROCEDURE `deleteGroups`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  delete from groups where groups_id=primParam  limit 1;
END$$

CREATE  PROCEDURE `deletePlayers`(IN `primParam` int(11) unsigned , IN `statusParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  CASE  statusParam
        WHEN  2  then delete from user where user_id=primParam and user_status_id_FK<2 limit 1;
        WHEN  3 then delete from user where user_id=primParam and user_status_id_FK<>3 limit 1;
      END CASE;
END$$

CREATE  PROCEDURE `deleteRow`(IN `tblParam` CHAR(64), IN `primParam` int(11) unsigned , IN `bookhouse_id_FKParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  CASE  tblParam
      WHEN  "sports"  then delete from sports where sports_id=primParam  limit 1;  call getTable("sports",bookhouse_id_FKParam);
      WHEN  "groups"  then delete from groups where groups_id=primParam  limit 1;  call getTable("groups",bookhouse_id_FKParam);
      WHEN  "teams"  then delete from teams where teams_id=primParam  limit 1;  call getTable("teams",bookhouse_id_FKParam);
      ELSE select "false";
    END CASE;
END$$

CREATE  PROCEDURE `deleteSports`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  delete from sports where sports_id=primParam limit 1;
END$$

CREATE  PROCEDURE `deleteSupertoto`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare  id_FKVariable int;
     select bookhouse_id_FK into id_FKVariable from supertoto where supertoto_id=primParam  limit 1;
     delete from supertoto where supertoto_id=primParam limit 1;
     call selectSupertoto(id_FKVariable );
END$$

CREATE  PROCEDURE `deleteSupertotoTeam`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare  id_FKVariable int;
     select supertoto_id_FK into id_FKVariable from supertoto_teams where supertoto_teams_id=primParam  limit 1;
     delete from supertoto_teams where supertoto_teams_id=primParam limit 1;
     call selectSupertotoTeams(id_FKVariable);
END$$

CREATE  PROCEDURE `deleteTeams`(IN `primParam` int(11) unsigned , IN `groupParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  delete from teams where teams_id=primParam  limit 1;
      CALL selectTeams(groupParam) ;
END$$

CREATE  PROCEDURE `getTable`(IN `tblParam` CHAR(64), IN `primParam` int(11) unsigned )
    READS SQL DATA
    DETERMINISTIC
BEGIN
  CASE tblParam
      WHEN  "sports"  THEN Select name_of_sport as name,active as live, sports_id as idTable from sports where bookhouse_id_FK=primParam;
      WHEN  "groups"  THEN Select groups_id as idGroups, name_of_group as name,  active as live from groups where sports_id_FK=primParam;
      WHEN  "teams"  THEN Select teams_id as idTeams,  team_name as name from teams where groups_id_FK=primParam;
      WHEN  "pregroups"  THEN Select prebuild_groups_id as prebuildId, name_of_group as name from prebuild_groups;
      WHEN  "preteams"   THEN Select  name_of_team as name from prebuild_teams where prebuild_groups_id_FK=primParam;
      ELSE select "false";
    END CASE;
END$$

CREATE  PROCEDURE `insertAdmin`(IN `user_nameParam` varchar(20), IN `passwordParam` varchar(50), IN `moneyParam` float, IN `first_nameParam` varchar(50), IN `last_nameParam` varchar(50), IN `emailParam` varchar(200), IN `timeParam` datetime, IN `userstatusParam` int(11) unsigned , IN `saltParam` char(9), IN `adminIdParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  insert into user  values (null,   user_nameParam, passwordParam, 0,  timeParam,first_nameParam,last_nameParam,emailParam,saltParam,userstatusParam,null);
END$$

CREATE  PROCEDURE `insertBet`(IN `nameParam` varchar(100), IN `groupIdParam` int(11) unsigned , IN `timeParam` datetime, IN `timeActiveParam` datetime, IN `nowParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  IF nowParam >= timeParam ||nowParam >= timeActiveParam || timeParam<=timeActiveParam  THEN
        select "time is not ok";
      ELSE
         insert into bets (bets_id, bet_name, groups_id_FK, add_date, end_date,  bet_active)values(null,nameParam,groupIdParam, nowParam,timeParam ,timeActiveParam );
         select last_insert_id() as number;
      END IF;
END$$

CREATE  PROCEDURE `insertBetType`(IN `nameParam` varchar(250), IN `oddParam` float, IN `primParam` int(11) unsigned , IN `primParamTeam` int(11) unsigned , IN `nowParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare betId int(11) unsigned ;
    declare eventBetId int(11) unsigned ;
    declare teamId int(11) unsigned ;
    set teamId = primParamTeam ;

      if teamId is not null then
      SELECT t.bets_id_FK  into betId  FROM teams_has_bets t where t.teams_has_bets_id=teamId;
      SELECT eb.bets_id_FK  into eventBetId  FROM event_bets eb where eb.event_bets_id=primParam;


      if betId<>eventBetId then
         set teamId=null;
      end if;


     end if;

    insert into bets_type  values(null,primParam ,nameParam,nowParam,teamId );
    insert into odd_value values(null,oddParam,last_insert_id(),nowParam );
END$$

CREATE  PROCEDURE `insertBetTypeOne`(IN `nameParam` varchar(250), IN `oddParam` float, IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  insert into bets_type (bet_types_id, name, odd_value, bets_id_FK,date_created)values(null,nameParam,oddParam,primParam ,now() );
    call selectBetsType(primParam) ;
END$$

CREATE  PROCEDURE `insertEvent`(IN `nameParam` varchar(300), IN `bookHouseIdParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  insert into events_table  values (null,nameParam, now(),bookHouseIdParam);
       select last_insert_id() as number;
END$$

CREATE  PROCEDURE `insertEventBet`(IN `bets_id_FKParam` int(11) unsigned , IN `event_id_FKParam` int(11) unsigned , IN `event_bets_nameParam` varchar(200), IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare  betsId int(11) unsigned ;

      select bets_id into betsId from bets where bets_id=bets_id_FKParam and  end_date > timeParam ;

      if betsId is not null then

        insert into event_bets values(null, betsId, event_id_FKParam,  event_bets_nameParam,null, null);
        select last_insert_id() as number;
        else
           select "notok";
      end if;
END$$

CREATE  PROCEDURE `insertEventSupertoto`(IN `nameParam` varchar(300) )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  insert into events_table_supertoto  values (null,nameParam, now());
       select last_insert_id() as number;
END$$

CREATE  PROCEDURE `insertEventType`(IN `nameParam` varchar(300), IN `eventdIDParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  insert into event_value  values (null,eventdIDParam, now(),nameParam);
END$$

CREATE  PROCEDURE `insertEventTypeSupertoto`(IN `nameParam` varchar(300), IN `eventdIDParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
     insert into event_value_supertoto  values (null,eventdIDParam, now(),nameParam);
END$$

CREATE  PROCEDURE `insertGroups`(IN `name_of_groupParam` varchar(100), IN `sports_id_FKParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  insert into groups  values (null,name_of_groupParam,now(),sports_id_FKParam  );
END$$

CREATE  PROCEDURE `insertNewOdd`(IN `paramValue` float, IN `idParam` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare endTime datetime;
     declare eventBetsId int(11) unsigned ;

     select event_bets_id into eventBetsId from event_bets where event_bets_id=( select event_bets_id_FK from bets_type where bet_types_id=idParam limit 1) limit 1;

     SELECT  end_date into endTime FROM bets where
     bets_id=
     (
       select bets_id_FK from event_bets where event_bets_id=
       (
         select event_bets_id_FK from bets_type where bet_types_id=idParam limit 1)
         limit 1
       )
      limit 1;

    IF endTime > timeParam  THEN
        insert into odd_value value(null, paramValue,idParam, timeParam);
    ELSE
      select "nije ok";
    END IF;

    SELECT  bt.name as namedata, l.odd_value  as oddvalue, l.bet_types_id_FK as betTypesId ,  l.data_created_oddValue  as created   FROM latest_odd_value l inner join bets_type bt on bt.bet_types_id=l.bet_types_id_FK  and bt.event_bets_id_FK=eventBetsId  order by odd_value_id desc;
    SELECT  bt.name as namedata, od.odd_value as oddvalue ,  od.data_created as created FROM bets_type bt, odd_value od where bt.bet_types_id=od.bet_types_id_FK and bt.event_bets_id_FK=eventBetsId order by data_created desc;
END$$

CREATE  PROCEDURE `insertOnePrebuildTeam`(IN `primParam` int(11) unsigned , IN `primParamGroupId` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  insert into teams(teams_id, add_date, team_name, groups_id_FK) select null,now(), name_of_team,primParamGroupId from prebuild_teams where prebuild_teams_id=primParam;
      CALL selectTeams(primParamGroupId);
END$$

CREATE  PROCEDURE `insertPrebuildGroups`(IN `nameParam` varchar(100))
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  insert into prebuild_groups values(null,"PremierShip");
END$$

CREATE  PROCEDURE `insertPrebuildTeams`(IN `primParam` int(11) unsigned , IN `primParamGroupId` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  insert into teams(teams_id, add_date, team_name, groups_id_FK) select null,now(), name_of_team,primParamGroupId from prebuild_teams where prebuild_groups_id_FK=primParam;
      CALL selectTeams(primParamGroupId);
END$$

CREATE  PROCEDURE `insertSport`(IN `name_of_sportParam` varchar(100), IN `bookhouse_id_FKParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  insert into sports  values (null,name_of_sportParam, bookhouse_id_FKParam ,now() );
END$$

CREATE  PROCEDURE `insertSupertotoTeams`(IN `supertoto_team_nameParam` varchar(250), IN `supertoto_id_FKParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  insert into supertoto_teams(supertoto_teams_id, supertoto_team_name, supertoto_id_FK)values(null,supertoto_team_nameParam, supertoto_id_FKParam);
END$$

CREATE  PROCEDURE `insertSuperttoto`(IN `supertotonameParam` varchar(250), IN `date_visibleParam` datetime, IN `date_endParam` datetime, IN `column_valuesParam` varchar(250), IN `bookhouse_id_Param` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  insert into supertoto (supertoto_id, supertoto_name, date_added, date_visible, date_end, column_values,bookhouse_id_FK) values(null,supertotonameParam,now(),date_visibleParam ,date_endParam,column_valuesParam,bookhouse_id_Param );
   select last_insert_id() as number;
END$$

CREATE  PROCEDURE `insertTeam`(IN `name_of_teamParam` varchar(250), IN `group_idParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  insert into teams (teams_id, add_date, team_name, groups_id_FK) values (null,now(),name_of_teamParam, group_idParam );
      CALL selectTeams(group_idParam) ;
END$$

CREATE  PROCEDURE `insertTeamToEvent`(IN `primTeam` int(11) unsigned , IN `primEvent` int(11) unsigned , IN `timeParam` datetime, IN `insOrSel` varchar (20))
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  DECLARE dateFrombet datetime;

        select  bet_active into dateFrombet from bets where bets_id=primEvent;

        IF  timeParam< dateFrombet  THEN
              IF insOrSel = "insert" THEN
                insert into  teams_has_bets  values (null,primTeam,primEvent);
              ELSE
                insert into  teams_has_bets  values (null,primTeam,primEvent);
                call selectEventBetTeams(primEvent);
              END IF;
        END IF;
END$$

CREATE  PROCEDURE `insertTransactions`(IN `moneyParam` float, IN `statusParam` tinyint(4), IN `userParam` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  IF statusParam = 0 THEN
           insert into transaction_in values(null,userParam, moneyParam, 1, null,timeParam);

        ELSEif  statusParam = 1 THEN
                insert into transaction_out values(null, null, moneyParam, 1,userParam,timeParam);
        END IF;
END$$

CREATE  PROCEDURE `insertUser`(IN `user_nameParam` varchar(20), IN `passwordParam` varchar(50), IN `moneyParam` float, IN `first_nameParam` varchar(50), IN `last_nameParam` varchar(50), IN `emailParam` varchar(200), IN `timeParam` datetime, IN `userstatusParam` int(11) unsigned , IN `saltParam` char(9), IN `adminIdParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
 declare lastInsert int(11) unsigned ;

      START TRANSACTION;



    insert into user  values (null,   user_nameParam, passwordParam, 0,  timeParam,first_nameParam,last_nameParam,emailParam,saltParam,userstatusParam,null,null,null);

    select last_insert_id() into lastInsert;

      insert into transaction_in values(null, (select last_insert_id()), moneyParam, adminIdParam , null,timeParam,null);

    insert into transaction_out values(null, null, 0, adminIdParam ,lastInsert,timeParam);


      COMMIT;
END$$

CREATE  PROCEDURE `registerUser`(IN `user_nameParam` varchar(20), IN `passwordParam` varchar(50), IN `first_nameParam` varchar(50), IN `last_nameParam` varchar(50), IN `emailParam` varchar(200), IN `timeParam` datetime, IN `userstatusParam` int(11) unsigned , IN `saltParam` char(9),in porukaParam varchar(50),in odgovorParam varchar(50))
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN

  declare lastInsert int(11) unsigned ;

  START TRANSACTION;

     insert into user  values (null,   user_nameParam, passwordParam, 0,  timeParam,first_nameParam,last_nameParam,emailParam,saltParam,userstatusParam,null,porukaParam,odgovorParam);
     select last_insert_id() into lastInsert;

     insert into transaction_in values(null, (select last_insert_id()), (SELECT default_money_value FROM bookhouse b where bookhouse_id=1), null , null,timeParam,null);
     insert into transaction_out values(null, null, 0, null ,lastInsert,timeParam);

COMMIT;

END$$

CREATE  PROCEDURE `resetArhiveBets`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  update event_bets set  score=null , correctType=null where correctType is not null and event_bets_id=primParam;

  update bet_slip_with_events set status=null where status=2 and  event_bets_id=primParam ;
END$$

CREATE  PROCEDURE `selectAddEmail`(IN `emailParam` varchar(250), IN `user_idParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  select user_id   FROM user where  email=emailParam  and user_id<>user_idParam;
END$$

CREATE  PROCEDURE `selectAddUser`(IN `user_nameParam` varchar(20), IN `user_idParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  select user_id  FROM user where   user_name=user_nameParam and user_id<>user_idParam;
END$$

CREATE  PROCEDURE `selectAllGroups`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  Select g.name_of_group as name ,g.groups_id as idGroups,  s.name_of_sport as sportName from groups g, sports s where s.sports_id=g.sports_id_FK and s.bookhouse_id_FK=primParam  ;
END$$

CREATE  PROCEDURE `selectBetArhive`(IN `primParam` int(11) unsigned , IN `timeParam` datetime, IN `eventId` int(11) unsigned , IN `betIdParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  DECLARE event_data VARCHAR(626);
  DECLARE stmt_expr VARCHAR(528);
  DECLARE primParamString VARCHAR(626);
  DECLARE selectBetParamString VARCHAR(626);
  DECLARE timeParamString VARCHAR(626);
  DECLARE timeParamStringMore VARCHAR(626);
  DECLARE betSelectData VARCHAR(626);




  IF eventId = 0 THEN
  SET event_data="";
  ELSE
  SET event_data=CONCAT("and eb.event_id_FK=",eventId );
  END IF;



  IF betIdParam = 0 THEN
  SET betSelectData ="";
  ELSE
  SET betSelectData=CONCAT("and b.bets_id=",betIdParam );
  END IF;

  SET @stmt_expr = CONCAT('SELECT  eb.event_bets_id as eventbetId , b.end_date as dateinfo , b.bets_id as betId , c.count, e.event_name as eventname,     b.bet_active as active , eb.event_bets_name as name , eb.score as result , eb.correctType as correct  FROM   events_table e,cont c, bets b,   event_bets eb where  c.bets_id_FK=b.bets_id   ',primParamString,' and eb.bets_id_FK=b.bets_id  ',event_data,' and   eb.event_id_FK=e.event_id and "',timeParam,'" ',timeParamStringMore,'  ',selectBetParamString,' ',betSelectData,';');
  prepare stmt FROM @stmt_expr;
  execute stmt  ;
  deallocate prepare stmt;
END$$

CREATE  PROCEDURE `selectBetBasic`(IN `primParam` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT   b.bet_name as name ,  b.bets_id as betId   , end_date as enddate, bet_active as dateactive FROM  bets b  where groups_id_FK= primParam and timeParam < b.end_date order by add_date desc;
END$$

CREATE  PROCEDURE `selectBetData`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  CALL selectSports( );
   CALL selectGroupAndSports( ) ;
END$$

CREATE  PROCEDURE `selectBetEditArihve`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT eb.event_bets_id as eventbetId, et.event_name as eventtypename,  eb.event_bets_name as eventname,   b.bet_name as betname,     b.end_date as dateinfo, b.bet_active as active, eb.score as result
  , bt.name as typename,t.team_name as team
  from event_bets eb  left join events_table et on et.event_id=eb.event_id_FK
     left join bets b on eb.bets_id_FK=b.bets_id
     left join bets_type bt on eb.event_bets_id= bt.event_bets_id_FK and eb.correctType=bt.bet_types_id
     left join teams_has_bets tb on bt.teams_has_bets_id_FK=tb.teams_has_bets_id left join teams t on t.teams_id=tb.teams_id_FK

     where  eb.event_bets_id=primParam  and eb.correctType is not null  ;

  SELECT  bt.name as namedata, od.odd_value as oddvalue ,  od.data_created as created FROM bets_type bt, odd_value od where bt.bet_types_id=od.bet_types_id_FK and bt.event_bets_id_FK=primParam order by data_created desc;
END$$

CREATE  PROCEDURE `selectBetEditEnd`(IN `primParam` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT eb.event_bets_id as eventbetId, et.event_name as eventtypename,  eb.event_bets_name as eventname,   b.bet_name as betname,     b.end_date as dateinfo, b.bet_active as active from event_bets eb  left join events_table et on et.event_id=eb.event_id_FK      left join bets b on eb.bets_id_FK=b.bets_id and eb.event_bets_id=primParam where  timeParam>b.end_date  ;

    SELECT bt.bet_types_id as betTypeId, t.team_name as winner,  name as oddname,   teams_has_bets_id_FK as teamId, odd_value_id as oddid, odd_value as odd
    FROM bets_type bt
    left join latest_odd_value lov on bt.bet_types_id = lov.bet_types_id_FK
    left join teams_has_bets tb on  bt.teams_has_bets_id_FK=tb.teams_has_bets_id
    left join teams t on  t.teams_id=tb.teams_id_FK
    where bt.event_bets_id_FK= primParam order by bet_types_id ;
END$$

CREATE  PROCEDURE `selectBets`(IN `primParam` int(11) unsigned , IN `timeParam` datetime, IN `eventId` int(11) unsigned , IN `statusParam` smallint, IN `betIdParam` int(11) unsigned , IN `arhiveMonthParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  DECLARE event_data VARCHAR(626);
  DECLARE stmt_expr VARCHAR(528);
  DECLARE primParamString VARCHAR(626);
  DECLARE selectBetParamString VARCHAR(626);
  DECLARE timeParamString VARCHAR(626);
  DECLARE timeParamStringMore VARCHAR(626);
  DECLARE betSelectData VARCHAR(626);


  IF primParam = 0 THEN
  SET primParamString="";
  ELSE
  SET primParamString=CONCAT("and b.groups_id_FK=",primParam );
  END IF;

  IF eventId = 0 THEN
  SET event_data="";
  ELSE
  SET event_data=CONCAT("and eb.event_id_FK=",eventId );
  END IF;



  IF betIdParam = 0 THEN
  SET betSelectData ="";
  ELSE
  SET betSelectData=CONCAT("and b.bets_id=",betIdParam );
  END IF;


  CASE statusParam
  WHEN  0 THEN  SET selectBetParamString="and eb.correctType is null" ;set timeParamStringMore=CONCAT("and  '",timeParam,"' < b.end_date and b.bet_active < '",timeParam,"' " );
  WHEN  1 THEN  SET selectBetParamString="and eb.correctType is null" ;set timeParamStringMore=CONCAT("and  '",timeParam,"' > b.end_date");
  WHEN  2 THEN  SET selectBetParamString="and eb.correctType is not null " ;set timeParamStringMore=CONCAT("and  b.end_date > '",arhiveMonthParam,"' and b.end_date < date_add('",arhiveMonthParam,"', interval 1 month) ");
  WHEN  3 THEN  SET selectBetParamString="" ;set timeParamStringMore=CONCAT("and '",timeParam,"' < b.bet_active");
  END CASE;



  SET @stmt_expr = CONCAT('SELECT  eb.event_bets_id as eventbetId , b.end_date as dateinfo , b.bets_id as betId , c.count, e.event_name as eventname,     b.bet_active as active , eb.event_bets_name as name  ,e.event_id as eventId FROM   events_table e,cont c, bets b,   event_bets eb where  c.bets_id_FK=b.bets_id   ',primParamString,' and eb.bets_id_FK=b.bets_id  ',event_data,' and   eb.event_id_FK=e.event_id  ',timeParamStringMore,'  ',selectBetParamString,' ',betSelectData,';');
  prepare stmt FROM @stmt_expr;
  execute stmt  ;
  deallocate prepare stmt;


  SET @stmt_expr = CONCAT('SELECT   eb.event_bets_id as eventbetId , bt.name as oddname,od.odd_value as odd,   bt.bet_types_id as betTypeId    FROM latest_odd_value od,events_table e,   bets b, bets_type bt , event_bets eb where eb.event_bets_id=bt.event_bets_id_FK     ',primParamString,' and eb.bets_id_FK=b.bets_id  ',event_data,' and od.bet_types_id_FK=bt.bet_types_id and eb.event_id_FK=e.event_id   ',timeParamStringMore,'    ',selectBetParamString,' ',betSelectData,';');
  prepare stmt FROM @stmt_expr;
  execute stmt  ;
  deallocate prepare stmt;
END$$

CREATE  PROCEDURE `selectBetsType`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  select   od.odd_value_id as oddid, od.odd_value as odd, od.data_created as datecreated , bt.bet_types_id as typeId,  bt.name as oddname   from bets_type bt, odd_value od where bt.event_bets_id_FK=primParam and od.bet_types_id_FK=bt.bet_types_id;
END$$

CREATE  PROCEDURE `selectBetTeams`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT teams_has_bets_id as thbId, team_name as name  FROM teams_has_bets tb left join teams t on t.teams_id=tb.teams_id_FK where bets_id_FK=primParam;
END$$

CREATE  PROCEDURE `selectCeckEmail`(IN `emailParam` varchar(250))
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  select user_id   FROM user where  email=emailParam ;
END$$

CREATE  PROCEDURE `selectCheckForGroup`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  select groups_id from groups where groups_id =primParam limit 1;
END$$

CREATE  PROCEDURE `selectCheckMoney`(IN `userParam` int(11) unsigned , IN `moneyParam` float)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare moneyUser float;

       SELECT  sum( (SELECT  sum(t.money) FROM transaction_in t where t.user_id_FK=userParam)-(SELECT  sum(b.money) FROM transaction_out b  where b.user_id_FK=userParam)) into moneyUser;

      IF (moneyUser-moneyParam)> -1  THEN
        select "ok";
      ELSE
          select "nije ok";
      END IF;
END$$

CREATE  PROCEDURE `selectCheckUser`(IN `user_nameParam` varchar(20))
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  select user_id  FROM user where   user_name=user_nameParam;
END$$

CREATE  PROCEDURE `selectCountBets`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT count(*),event_id_FK as eventId,bet_name as name FROM bets where groups_id_FK=primParam group by bet_name;
END$$

CREATE  PROCEDURE `selectDatabaseData`()
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  select  house_name as name , timezone as zone, default_money_value as funds, can_user_register as user from bookhouse limit 1;
END$$

CREATE  PROCEDURE `selectEditBet`(IN `primParam` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT event_bets_id as eventbetId,  event_id_FK as eventId, event_bets_name as eventname,   bets_id as betId,   groups_id_FK,  end_date as dateinfo, bet_active as active from event_bets eb left join bets b on eb.bets_id_FK=b.bets_id and eb.event_bets_id=primParam where  timeParam<b.bet_active  ;

    SELECT bt.bet_types_id as betTypeId, t.team_name as winner,  name as oddname,   teams_has_bets_id_FK as teamId, odd_value_id as oddid, odd_value as odd
    FROM bets_type bt
    left join latest_odd_value lov on bt.bet_types_id = lov.bet_types_id_FK
    left join teams_has_bets tb on  bt.teams_has_bets_id_FK=tb.teams_has_bets_id
    left join teams t on  t.teams_id=tb.teams_id_FK
    where bt.event_bets_id_FK= primParam order by bet_types_id ;

    call selectEvents(1);
END$$

CREATE  PROCEDURE `selectEditEvent`(IN `primParam` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT  bets_id as betId, bet_name as name, groups_id_FK as groupId,  end_date as endDate, bet_active as activeDate, name_of_group as groupName, name_of_sport as sportName   FROM bets b  left join groups g on g.groups_id=b.groups_id_FK left join sports s on s.sports_id=g.sports_id_FK where b.bets_id=primParam and  timeParam < bet_active ;
END$$

CREATE  PROCEDURE `selectEventBets`(IN `primBets` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT eb.event_bets_id as eventBetId, eb.event_bets_name as name, e.event_name as ename FROM  event_bets eb left outer join events_table e on eb.event_id_FK=e.event_id inner join bets b on b.end_date>timeParam and b.bets_id=primBets where eb.bets_id_FK= primBets;
END$$

CREATE  PROCEDURE `selectEventBetTeams`(IN `primTeam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT t.team_name as name , t.teams_id as teamsId , tb.teams_has_bets_id as teamHasId FROM teams_has_bets tb,teams t where tb.teams_id_FK=t.teams_id and bets_id_FK=primTeam ;
END$$

CREATE  PROCEDURE `selectEventCount`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT count(*) as number FROM event_value e where event_id_FK=primParam;
END$$

CREATE  PROCEDURE `selectEventCountSupertoto`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
    SELECT count(*) as number FROM event_value_supertoto e where event_id_FK=primParam;
END$$

CREATE  PROCEDURE `selectEvents`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  Select event_id as eventId, event_name as name from events_table where sports_id_FK=primParam order by event_id;
END$$

CREATE  PROCEDURE `selectEventsSupertoto`()
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  Select event_id as eventId, event_name as name from events_table_supertoto;
END$$

CREATE  PROCEDURE `selectGroupAndSports`()
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  Select  g.sports_id_FK as sportId,   g.groups_id as idGroups, g.name_of_group as name      from groups g  ;
END$$

CREATE  PROCEDURE `selectGroups`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  Select groups_id as idGroups, name_of_group as name  from groups where sports_id_FK=primParam;
END$$

CREATE  PROCEDURE `selectLoginRememberUser`(IN `usernameParam` varchar(20), IN `passwordParam` varchar(50))
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  select user_id , user_status_id_FK from user where user_name=usernameParam  and  sercret_ans=passwordParam limit 1;
END$$

CREATE  PROCEDURE `selectLoginUser`(IN `usernameParam` varchar(20), IN `passwordParam` varchar(50))
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  select user_id , user_status_id_FK from user where user_name=usernameParam  and password=passwordParam limit 1;
END$$

CREATE  PROCEDURE `selectOneInfoBet`(IN `ticketParam` int(11) unsigned , IN `adminId` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  case adminId
  WHEN  0 THEN

  select
  bs.ticket_id as ticketId,       eb.event_bets_name as evenName, eb.score as result, eb.correctType as corectBetTyp, od.odd_value odd,b.end_date as end,bt.name as youBetTypeSelection,bt.bet_types_id as youBetTypeId,et.event_name as eventTypeName
  from bet_slip bs
  inner join bets_type_has_bet_slip bth on bs.ticket_id=bth.ticket_id_FK
  left join bets_type bt on bt.bet_types_id=bth.bet_types_id_FK
  left join event_bets eb on eb.event_bets_id=bt.event_bets_id_FK
  left join odd_value od on od.odd_value_id=odd_value_id_FK
  left join bets b on b.bets_id=bth.bets_id_FK
  left join events_table et on et.event_id=eb.event_id_FK
  where bs.ticket_id=ticketParam group by  bth.ticket_id_FK, bth.bet_types_id_FK;


  WHEN  1 THEN

  select
  bs.ticket_id as ticketId,      eb.event_bets_name as evenName, eb.score as result, eb.correctType as corectBetTyp, od.odd_value odd,b.end_date as end,bt.name as youBetTypeSelection,bt.bet_types_id as youBetTypeId,et.event_name as eventTypeName
  from bet_slip bs
  inner join bets_type_has_bet_slip bth on bs.ticket_id=bth.ticket_id_FK
  left join bets_type bt on bt.bet_types_id=bth.bet_types_id_FK
  left join event_bets eb on eb.event_bets_id=bt.event_bets_id_FK
  left join odd_value od on od.odd_value_id=odd_value_id_FK
  left join bets b on b.bets_id=bth.bets_id_FK
  left join events_table et on et.event_id=eb.event_id_FK
  where bs.ticket_id=ticketParam group by  bth.ticket_id_FK, bth.bet_types_id_FK;

  END CASE;
END$$

CREATE  PROCEDURE `selectOneUser`(IN `userParam` varchar(11))
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  select user_name as name,     first_name as firstname, last_name as lastname, email as mail, user_id as userId from user where user_id=userParam;
END$$

CREATE  PROCEDURE `selectOnlyBets`(IN `primParam` int(11) unsigned , IN `timeParam` datetime, IN `timeParamTo` int(11) unsigned , IN `eventId` int(11) unsigned , IN `statusParam` smallint, IN `betIdParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  DECLARE event_data VARCHAR(626);
  DECLARE stmt_expr VARCHAR(528);
  DECLARE primParamString VARCHAR(626);
  DECLARE timeParamStringMore VARCHAR(626);
  DECLARE betSelectData VARCHAR(626);
  declare countData varchar (30);


  IF primParam = 0 THEN
  SET primParamString="";
  ELSE
  SET primParamString=CONCAT("and b.groups_id_FK=",primParam );
  END IF;



  IF betIdParam = 0 THEN
  SET betSelectData ="";
  ELSE
  SET betSelectData=CONCAT("and b.bets_id=",betIdParam );
  END IF;



  CASE statusParam
  WHEN  0 THEN    set timeParamStringMore=CONCAT("< b.end_date and b.bet_active < '",timeParam,"' " ) ;set countData="left join cont c";
  WHEN  1 THEN   set timeParamStringMore="> b.end_date"; set countData="inner join countfinished c" ;
  WHEN  3 THEN   set timeParamStringMore="< b.bet_active" ;set countData="left join cont c";
  END CASE;



  SET @stmt_expr = CONCAT('
  SELECT    b.end_date as dateinfo , b.bet_name as nameBet,  b.bets_id as betId , c.count,
    b.bet_active as active  ,b.groups_id_FK as groupId    FROM
      bets b   ',countData,'  on c.bets_id_FK=b.bets_id

   ',primParamString,'    where "',timeParam,'" ',timeParamStringMore,'  ',betSelectData,';');
  prepare stmt FROM @stmt_expr;

  execute stmt  ;
  deallocate prepare stmt;
END$$

CREATE  PROCEDURE `selectPasswordRemUvod`(in lastnameParam varchar(50),in emailParam varchar(250))
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
      select  secret_que as pitanje, user_name as user from user where last_name=lastnameParam and email=emailParam limit 1;
END$$

CREATE  PROCEDURE `selectPrebuildGroups`()
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  select prebuild_groups_id as id, name_of_group as name from prebuild_groups;
END$$

CREATE  PROCEDURE `selectPregroups`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  Select prebuild_groups_id as prebuildId, name_of_group as name from prebuild_groups;
END$$

CREATE  PROCEDURE `selectPreteams`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  Select  name_of_team as name, prebuild_teams_id as id from prebuild_teams where prebuild_groups_id_FK=primParam;
END$$

CREATE  PROCEDURE `selectSalt`(IN `usernameParam` varchar(20))
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT salt FROM `user` where user_name=usernameParam;
END$$

CREATE  PROCEDURE `selectSearchUser`(IN `limitParam` int(11) unsigned , IN `criteraParam` tinyint(4), IN `terminParam` varchar (100))
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  CASE criteraParam
         WHEN  0  THEN

  SET @lim = CONCAT('"localhost',terminParam,'localhost" LIMIT ', limitParam , ', 30' );
  SET @q = "select user_name as name,  last_login as lastlogin,  first_name as firstname, last_name as lastname, email as mail, user_id as userId from user where user_name LIKE";
  SET @count = CONCAT('select count(*) from user where user_name LIKE "localhost',terminParam,'localhost"');

         WHEN  1 THEN
  SET @lim = CONCAT('"localhost',terminParam,'localhost" LIMIT ', limitParam , ', 30' );
  SET @q = "select user_name as name,  last_login as lastlogin,  first_name as firstname, last_name as lastname, email as mail, user_id as userId from user where first_name LIKE";
  SET @count =CONCAT('select  count(*) from user where first_name LIKE "localhost',terminParam,'localhost"');
         WHEN  2 THEN
  SET @lim = CONCAT('"localhost',terminParam,'localhost" LIMIT ', limitParam , ', 30' );
  SET @q = "select user_name as name,  last_login as lastlogin,  first_name as firstname, last_name as lastname, email as mail, user_id as userId from user where last_name LIKE";
  SET @count =CONCAT('select  count(*) from user where last_name LIKE "localhost',terminParam,'localhost"' );

        ELSE select "false";
      END CASE;

  SET @q = CONCAT(@q, @lim);
  PREPARE st FROM @q;
  EXECUTE st;
  DEALLOCATE PREPARE st;

  PREPARE ste FROM @count;
  EXECUTE ste;
  DEALLOCATE PREPARE ste;
END$$

CREATE  PROCEDURE `selectSports`()
    READS SQL DATA
    DETERMINISTIC
BEGIN
  Select name_of_sport as name,  sports_id as idTable from sports ;
END$$

CREATE  PROCEDURE `selectSupertoto`(IN `bookHouseParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT  s.supertoto_id as supertotoId, s.supertoto_name as name, s.date_visible as datevible, s.date_end as dateend, s.column_values as columnsdata FROM  supertoto s where s.bookhouse_id_FK=bookHouseParam  ;
END$$

CREATE  PROCEDURE `selectSupertotoTeams`(IN `dataIdParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT supertoto_teams_id as supertotoTeamId, supertoto_team_name as name FROM supertoto_teams where  supertoto_id_FK =dataIdParam;
END$$

CREATE  PROCEDURE `selectTeamFromBet`()
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  select * from teams_has_bets;
END$$

CREATE  PROCEDURE `selectTeams`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  Select teams_id as idTeams,  team_name as name from teams where groups_id_FK=primParam;
END$$

CREATE  PROCEDURE `selectTransactions`(IN `userParam` int(11) unsigned , IN `datefirstParam` datetime, IN `datesecondParam` datetime, IN `statusParam` varchar(10))
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  IF statusParam = "true" THEN
           SELECT    t.money as funds,   t.ticket_id_FK/t.ticket_id_FK as ticket, t.date_created as date FROM transaction_in t where t.user_id_FK=userParam  and t.date_created>datefirstParam and t.date_created<datesecondParam;
  ELSE
           SELECT    t.money as funds,   t.ticket_id_FK/t.ticket_id_FK as ticket, t.date_created as date FROM transaction_out t where t.user_id_FK=userParam and t.date_created>datefirstParam and t.date_created<datesecondParam;
  END IF;
END$$

CREATE  PROCEDURE `selectTypeEvents`(IN `eventsTypeIdParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  Select event_value_id as eventValueId,   event_value_name as name from event_value where event_id_FK=eventsTypeIdParam order by event_value_id;
END$$

CREATE  PROCEDURE `selectTypeEventsSupertoto`(IN `eventsTypeIdParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  Select event_value_id as eventValueId,   event_value_name as name from event_value_supertoto where event_id_FK=eventsTypeIdParam order by event_value_id;
END$$

CREATE  PROCEDURE `selectUsers`(IN `limitParam` int(11) unsigned , IN `userOrAdminParam` tinyint(4))
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare conditionParam varchar(50);

  if userOrAdminParam=0 then
   set conditionParam=" where user_status_id_FK<2 ";
  elseif userOrAdminParam=1 then
    set conditionParam=" where user_status_id_FK>1 ";
  end if;


  SET @lim = CONCAT(  conditionParam,' LIMIT ', limitParam , ', 30' );
  SET @q = "select user_name as name,  last_login as lastlogin,  first_name as firstname, last_name as lastname, email as mail, user_id as userId from user";

  SET @q = CONCAT(@q, @lim);
  PREPARE st FROM @q;
  EXECUTE st;
  DEALLOCATE PREPARE st;

  select count(*) from user;
END$$

CREATE  PROCEDURE `selectViewOdd`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT  bt.name as namedata, l.odd_value  as oddvalue, l.bet_types_id_FK as betTypesId ,  l.data_created_oddValue  as created   FROM latest_odd_value l inner join bets_type bt on bt.bet_types_id=l.bet_types_id_FK  and bt.event_bets_id_FK=primParam order by odd_value_id desc;
    SELECT  bt.name as namedata, od.odd_value as oddvalue ,  od.data_created as created FROM bets_type bt, odd_value od where bt.bet_types_id=od.bet_types_id_FK and bt.event_bets_id_FK=primParam order by data_created desc;
END$$

CREATE  PROCEDURE `select_bet_slip_user_admin`(IN `user_idParam` int(11) unsigned , IN `datefirstParam` datetime, IN `datesecondParam` datetime, IN `statusParam` varchar(10))
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  IF statusParam = "true" THEN

     SELECT

   u.ticket_id as ticketId, u.date_created as created,   null,  tio.money as fundsout,u.bettype as system


    FROM  bet_slip u
   inner join transaction_out tio on u.ticket_id=tio.ticket_id_FK and tio.ticket_id_FK is not null and tio.user_id_FK=user_idParam
    where u.status is  null and u.date_created>datefirstParam and u.date_created<datesecondParam ;

    SELECT
  u.ticket_id as ticketId,
  eb.event_bets_name as name,  btt.name as cor, odd.odd_value as odd

    FROM  bet_slip u
    left join transaction_out tio on u.ticket_id=tio.ticket_id_FK and tio.ticket_id_FK is not null and tio.user_id_FK=user_idParam
    left join bets_type_has_bet_slip bt on bt.ticket_id_FK=u.ticket_id
    left join bets_type btt on btt.bet_types_id=bt.bet_types_id_FK
    left join event_bets eb on btt.event_bets_id_FK=eb.event_bets_id
    left join odd_value odd on odd.odd_value_id=bt.odd_value_id_FK
   where u.status is  null and u.date_created>datefirstParam and u.date_created<datesecondParam group by  bt.ticket_id_FK, bt.bet_types_id_FK;


  ELSE


     SELECT

   u.ticket_id as ticketId, u.date_created as created,   sum(ti.money) as foundsin,  tio.money as fundsout,u.bettype as system


    FROM  bet_slip u
   left join transaction_in ti on u.ticket_id=ti.ticket_id_FK and ti.ticket_id_FK is not null and ti.user_id_FK=user_idParam
   inner join transaction_out tio on u.ticket_id=tio.ticket_id_FK and tio.ticket_id_FK is not null and tio.user_id_FK=user_idParam
    where u.status is  not null and u.date_created>datefirstParam and u.date_created<datesecondParam group by u.ticket_id ;




    SELECT
  u.ticket_id as ticketId,
  eb.event_bets_name as name,btt.name as cor, odd.odd_value as odd

    FROM  bet_slip u
    left join transaction_out tio on u.ticket_id=tio.ticket_id_FK and tio.ticket_id_FK is not null and tio.user_id_FK=user_idParam
    left join bets_type_has_bet_slip bt on bt.ticket_id_FK=u.ticket_id
    left join bets_type btt on btt.bet_types_id=bt.bet_types_id_FK
    left join event_bets eb on btt.event_bets_id_FK=eb.event_bets_id
    left join odd_value odd on odd.odd_value_id=bt.odd_value_id_FK
   where u.status is not null and u.date_created>datefirstParam and u.date_created<datesecondParam group by  bt.ticket_id_FK, bt.bet_types_id_FK ;


  END IF;
END$$

CREATE  PROCEDURE `test`(IN `primParam` int(11) unsigned , IN `timeParam` datetime, IN `timeParamTo` datetime, IN `eventId` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  DECLARE event_data VARCHAR(626);
  DECLARE timeParamEndString VARCHAR(528);
  DECLARE stmt_expr VARCHAR(528);
  DECLARE timeTo VARCHAR(626);
  DECLARE primParamString VARCHAR(626);

  IF primParam = 0 THEN
  SET primParamString="";
  ELSE
  SET primParamString=CONCAT("and b.groups_id_FK=",primParam );
  END IF;

  IF eventId = 0 THEN
  SET event_data="";
  ELSE
  SET event_data=CONCAT("and b.event_id_FK=",eventId );
  END IF;

  IF timeParamTo = "0000-00-00 00:00:00" THEN
  SET timeParamEndString="";
  ELSE
  SET timeParamEndString=CONCAT(" and ",timeParamTo," > end_date " );
  END IF;




  SET @stmt_expr = CONCAT('SELECT  bt.name as oddname,bt.odd_value as odd, b.bet_name as name ,b.end_date as dateinfo , b.bets_id as betId , c.count, e.event_name as eventname, bt.bet_types_id as betTypeId, e.event_id as eventId FROM events_table e,cont c, bets b, bets_type bt where c.bet_name=b.bet_name ',primParamString,' and bt.bets_id_FK=b.bets_id ',event_data,' and b.event_id_FK=e.event_id and "',timeParam,'" < end_date  ',timeParamEndString,';');
  prepare stmt FROM @stmt_expr;
  execute stmt  ;
  deallocate prepare stmt;
END$$

CREATE  PROCEDURE `Timezone`()
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  select  timezone from bookhouse where bookhouse_id=1;
END$$

CREATE  PROCEDURE `updateBetCanceled`(IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare exit handler for not found rollback;
        declare exit handler for sqlexception rollback;
        declare exit handler for sqlwarning rollback;

     START TRANSACTION;

            update select_unfinished_bets set status=5 where  status is null and  bet_types_finished is null and bet_types_complete is null ;
   INSERT INTO transaction_in (transaction_in_id, user_id_FK, money, admin_id_FK_1, ticket_id_FK,date_created)
           SELECT null,user_id_FK , money,1, ticket_id,timeParam  FROM possible_win pw WHERE pw.status=5;

          update select_unfinished_bets set status=2 where  status=5 ;

     COMMIT;
END$$

CREATE  PROCEDURE `updateBetData`(IN `dataParam` varchar(250), IN `corectTypeParam` int(11) unsigned , IN `timeParam` datetime, IN `adminIdParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  DECLARE betPrim int(11) unsigned ;
       declare primParam int(11) unsigned ;


        declare exit handler for not found rollback;
        declare exit handler for sqlexception rollback;
        declare exit handler for sqlwarning rollback;


   START TRANSACTION;

          select event_bets_id_FK into primParam from  bets_type where bet_types_id=corectTypeParam;
          select bets_id_FK into betPrim from event_bets where event_bets_id =primParam;

          update event_bets   set score=dataParam , correctType=corectTypeParam    where  event_bets_id=primParam and bets_id_FK=(select b.bets_id from bets b where b.end_date<timeParam and b.bets_id=betPrim limit 1) limit 1;
          update select_unfinished_bets set status=1 where  bet_types_finished =bet_slip_system_all;



           INSERT INTO transaction_in (transaction_in_id, user_id_FK, money, admin_id_FK_1, ticket_id_FK,date_created,system)
           SELECT null,user_id_FK , possible_win,adminIdParam , ticket_id,timeParam,bet_system_comb   FROM possible_win pw where  bet_types_complete =bet_types_correct  ;

         update bet_slip set status=2 where status =1;




      COMMIT;
END$$

CREATE  PROCEDURE `updateBetOdds`(IN `dataParam` int(11) unsigned , IN `primParam` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare bet_data_active datetime;

          select bet_active into bet_data_active from bets b where b.bets_id=(select bets_id_FK from event_bets where event_bets_id=primParam limit 1 );



          if bet_data_active > timeParam then

         update event_bets set event_id_FK=dataParam where event_bets_id=primParam limit 1;

         delete from bets_type where event_bets_id_FK=primParam;

         insert into bets_type (bet_types_id, event_bets_id_FK, name, date_created, teams_has_bets_id_FK) select null, primParam,event_value_name, timeParam, null from event_value where event_id_FK=dataParam ;

         insert into odd_value (odd_value_id, odd_value, bet_types_id_FK, data_created) select null, "0",bet_types_id, timeParam from bets_type where event_bets_id_FK=primParam  ;

         call selectBetsType(primParam);

             end if;
END$$

CREATE  PROCEDURE `updateBetOddsAll`(IN `primParam` int(11) unsigned , IN `oddParam` float, IN `timeParam` datetime, IN `teamsIdParam` int(11) unsigned , IN `nameParam` varchar(100), IN `primOdd` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare bet_data_active datetime;

      select bet_active into bet_data_active from bets b where b.bets_id=(select bets_id_FK from event_bets where event_bets_id=(select event_bets_id_FK from bets_type where bet_types_id=primParam limit 1) limit 1 );
      if bet_data_active>timeParam then

         update bets_type set  teams_has_bets_id_FK=teamsIdParam ,  name=nameParam  where bet_types_id=primParam  limit 1;
         update odd_value set  odd_value=oddParam where odd_value_id=primOdd limit 1;

      end if;
END$$

CREATE  PROCEDURE `updateBets`(IN `columnParam` CHAR(64), IN `dataParam` varchar(250), IN `primParam` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  CASE columnParam
         WHEN  "name"  THEN update bets set bet_name=dataParam where bets_id=primParam and  timeParam <  bet_active  limit 1;select bet_name as name from bets where bets_id=primParam and  timeParam <  bet_active  limit 1;
         WHEN  "dateact" THEN update bets set bet_active=dataParam where bets_id=primParam and  dataParam<end_date and  timeParam <  bet_active limit 1;select bet_active as name from bets where bets_id=primParam and  timeParam <  bet_active  limit 1;
         WHEN  "datend"  THEN update bets set end_date=dataParam where bets_id=primParam and bet_active<dataParam and  timeParam <  bet_active  limit 1;select end_date as name from bets where bets_id=primParam and  timeParam <  bet_active  limit 1;

        ELSE select "false";
      END CASE;
END$$

CREATE  PROCEDURE `updateBetsName`(IN `dataParam` varchar(250), IN `primParam` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare bet_data_active datetime;

      select bet_active into bet_data_active from bets b where b.bets_id=(select bets_id_FK from event_bets where event_bets_id=primParam limit 1 );
      if bet_data_active>timeParam then

      update event_bets set event_bets_name=dataParam where event_bets_id=primParam limit 1;
      select event_bets_name as name from event_bets where event_bets_id=primParam limit 1;
      end if;
END$$

CREATE  PROCEDURE `updateBetTeams`(IN `primTeam` int(11) unsigned , IN `primBet` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  DECLARE dateFrombet datetime;
        DECLARE primEvent int(11) unsigned ;

        select  bets_id_FK into primEvent  from teams_has_bets where teams_has_bets_id=primBet;
        select  bet_active into dateFrombet from bets where bets_id=primEvent;

        IF  timeParam < dateFrombet  THEN
                update teams_has_bets  set  teams_id_FK=primTeam where teams_has_bets_id=primBet;
                call selectEventBetTeams(primEvent);

        END IF;
END$$

CREATE  PROCEDURE `updateBetType`(IN `paramName` varchar(100), IN `idParam` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare endTime datetime;
     declare eventBetsId int(11) unsigned ;

     select event_bets_id into eventBetsId from event_bets where event_bets_id=( select event_bets_id_FK from bets_type where bet_types_id=idParam limit 1) limit 1;

     SELECT  end_date into endTime FROM bets where
     bets_id=
     (
       select bets_id_FK from event_bets where event_bets_id=
       (
         select event_bets_id_FK from bets_type where bet_types_id=idParam limit 1)
         limit 1
       )
      limit 1;

    IF endTime > timeParam  THEN
         update bets_type set  name=paramName where bet_types_id= idParam ;
    ELSE
      select "nije ok";
    END IF;

    SELECT  bt.name as namedata, l.odd_value  as oddvalue, l.bet_types_id_FK as betTypesId ,  l.data_created_oddValue  as created   FROM latest_odd_value l inner join bets_type bt on bt.bet_types_id=l.bet_types_id_FK  and bt.event_bets_id_FK=eventBetsId  order by odd_value_id desc;
    SELECT  bt.name as namedata, od.odd_value as oddvalue ,  od.data_created as created FROM bets_type bt, odd_value od where bt.bet_types_id=od.bet_types_id_FK and bt.event_bets_id_FK=eventBetsId order by data_created desc;
END$$

CREATE  PROCEDURE `updateBookhouse`(IN `dataParam` float, IN `statusParam` tinyint)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  CASE statusParam
  WHEN  0 THEN update bookhouse  set default_money_value=dataParam where bookhouse_id=1;select  default_money_value as funds from bookhouse where bookhouse_id=1;
  WHEN  1 THEN update bookhouse  set can_user_register=dataParam  where bookhouse_id=1; select  can_user_register as register from bookhouse where bookhouse_id=1;
  END CASE;
END$$

CREATE  PROCEDURE `updateEvents`(IN `dataParam` varchar(250), IN `primParam` int(11) unsigned , IN `sportIdParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  update events_table set event_name=dataParam where event_id=primParam limit 1;
      call selectEvents(sportIdParam);
END$$

CREATE  PROCEDURE `updateEventsSupertoto`(IN `dataParam` varchar(250), IN `primParam` int(11) unsigned  )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  update events_table_supertoto set event_name=dataParam where event_id=primParam limit 1;
      CALL selectEventsSupertoto();
END$$

CREATE  PROCEDURE `updateEventType`(IN `dataParam` varchar(250), IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare id_FKVariable int;
      Select event_id_FK into id_FKVariable  from event_value where  event_value_id=primParam  limit 1;
      update event_value set event_value_name=dataParam where  event_value_id=primParam limit 1;
      call selectTypeEvents(id_FKVariable);
END$$

CREATE  PROCEDURE `updateEventTypeSupertoto`(IN `dataParam` varchar(250), IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare id_FKVariable int;
      Select event_id_FK into id_FKVariable  from event_value_supertoto where  event_value_id=primParam  limit 1;
      update event_value_supertoto set event_value_name=dataParam where  event_value_id=primParam limit 1;
      call selectTypeEventsSupertoto(id_FKVariable);
END$$

CREATE  PROCEDURE `updateGroups`(IN `dataParam` varchar(250), IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  update groups set name_of_group=dataParam where groups_id=primParam limit 1;
END$$

CREATE  PROCEDURE `updateSport`(IN `dataParam` varchar(250), IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  update sports set name_of_sport=dataParam where sports_id=primParam limit 1;
END$$

CREATE  PROCEDURE `updateSupertoto`(IN `columnParam` CHAR(64), IN `dataParam` varchar(250), IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  CASE columnParam
         WHEN  "name"  THEN update supertoto set supertoto_name=dataParam where supertoto_id=primParam limit 1;select supertoto_name as name from supertoto where supertoto_id=primParam limit 1;
         WHEN  "dateend"  THEN update supertoto set date_end=dataParam where supertoto_id=primParam limit 1;select  date_end as dateend from supertoto where supertoto_id=primParam limit 1;
         WHEN  "datevisible"  THEN update supertoto set date_visible=dataParam where supertoto_id=primParam limit 1;select  date_visible as datevible  from supertoto where supertoto_id=primParam limit 1;
         WHEN  "column"  THEN update supertoto set column_values=dataParam where supertoto_id=primParam limit 1;select  column_values as columnsdata  from supertoto where supertoto_id=primParam limit 1;
       ELSE select "false";
      END CASE;
END$$

CREATE  PROCEDURE `updateTeams`(IN `dataParam` varchar(250), IN `primParam` int(11) unsigned , IN `groupParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  update teams set team_name=dataParam where teams_id=primParam limit 1;
      CALL selectTeams(groupParam) ;
END$$

CREATE  PROCEDURE `updateUserData`(IN `user_idParam` int(11) unsigned , IN `user_nameParam` varchar(20), IN `first_nameParam` varchar(50), IN `last_nameParam` varchar(50), IN `emailParam` varchar(200), IN `adminValue` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  CASE  adminValue

  WHEN  1 THEN  update user set  user_name= user_nameParam , first_name =first_nameParam , last_name=last_nameParam , email=emailParam   where user_id=user_idParam and  user_status_id_FK <2 limit 1;
  WHEN  2 THEN update user set  user_name= user_nameParam , first_name =first_nameParam , last_name=last_nameParam , email=emailParam   where user_id=user_idParam and  user_status_id_FK <3 limit 1;
  WHEN  3 THEN update user set  user_name= user_nameParam , first_name =first_nameParam , last_name=last_nameParam , email=emailParam   where user_id=user_idParam;
  END CASE;


  select user_name as name,     first_name as firstname, last_name as lastname, email as mail, user_id as userId from user where user_id=user_idParam  ;
END$$

CREATE  PROCEDURE `updateUserPassword`(IN `user_idParam` int(11) unsigned , IN `passwordParam` varchar(50), IN `saltParam` char(9))
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  update user set   password= passwordParam  ,salt= saltParam where user_id=user_idParam limit 1;
END$$

CREATE  PROCEDURE `userBetValidation`(IN `primParam` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  DECLARE timeData datetime ;
      DECLARE indDate int(11) unsigned ;

      SELECT  b.end_date into timeData from bets_type bt
      inner join event_bets eb on event_bets_id_FK=event_bets_id
      inner join  bets b on  eb.bets_id_FK= b.bets_id
      where bt.bet_types_id=primParam;

    IF   timeData is not null THEN

        IF  timeData < timeParam  THEN
          select primParam;
        ELSE
           select "ok";
        END IF;
        ELSE
             select primParam;
      END IF;
END$$

CREATE  PROCEDURE `userInsertBetSlip`(IN `timeParam` datetime, IN `userParam` int(11) unsigned , IN `moneyParam` float ,IN `systemParam` varchar(20))
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare lastId_bet_slip int(11) unsigned ;
    insert into bet_slip  values(null, timeParam, null,systemParam);
    select  last_insert_id() into lastId_bet_slip;
    insert into transaction_out values(null, (select last_insert_id()), moneyParam, null, userParam,timeParam );
    select  lastId_bet_slip as number;
END$$

CREATE  PROCEDURE `userOddValidation`(IN `primParam` int(11) unsigned , IN `oddParam` float)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  DECLARE oddData float;

          select odd_value into oddData from bets_type bt inner join odd_value od on bt.bet_types_id=od.bet_types_id_FK where bt.bet_types_id=primParam order by od.odd_value_id desc   limit 1;


          IF  oddData = oddParam   THEN
              select "ok";
          ELSE
             select primParam;
          END IF;
END$$

CREATE  PROCEDURE `userSelectActiveBets`(IN `primGroupsParam` int(11) unsigned , IN `timeParam` datetime, IN `primEventsParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT
  eb.event_bets_id as eventbetId
      ,b.end_date as
     dateinfo   , c.count, e.event_name as
     eventname, eb.event_bets_name as name
  ,
  b.bets_id as betId
       FROM events_table e,cont c, bets b,   event_bets eb where c.bets_id_FK=b.bets_id  and eb.bets_id_FK=b.bets_id   and eb.event_id_FK=e.event_id and timeParam< b.end_date and b.bet_active <timeParam
   and b.groups_id_FK= primGroupsParam and e.event_id=primEventsParam;


   SELECT  eb.event_bets_id as eventbetId ,  bt.name as oddname,od.odd_value as
    odd,    bt.bet_types_id as betTypeId
    FROM latest_odd_value od, bets b, bets_type bt , event_bets eb, events_table e where        eb.bets_id_FK=b.bets_id  and eb.event_id_FK=e.event_id    and od.bet_types_id_FK=bt.bet_types_id  and timeParam< b.end_date and b.bet_active <timeParam
    and b.groups_id_FK= primGroupsParam and  bt.event_bets_id_FK=eb.event_bets_id  and e.event_id=primEventsParam;
END$$

CREATE  PROCEDURE `userSelectActiveBetsAdd`(IN `primGroupsParam` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT
  eb.event_bets_id as eventbetId
      ,b.end_date as
     dateinfo   , c.count, e.event_name as
     eventname, eb.event_bets_name as name
  ,
  b.bets_id as betId

      FROM events_table e,cont c, bets b,   event_bets eb where c.bets_id_FK=b.bets_id  and eb.bets_id_FK=b.bets_id   and eb.event_id_FK=e.event_id and timeParam< b.end_date and b.bet_active <timeParam
   and b.bets_id= primGroupsParam  ;


   SELECT  eb.event_bets_id as eventbetId ,  bt.name as oddname,od.odd_value as
    odd,    bt.bet_types_id as betTypeId
    FROM latest_odd_value od, bets b, bets_type bt , event_bets eb, events_table e where  b.bets_id = primGroupsParam  and     eb.bets_id_FK=b.bets_id  and eb.event_id_FK=e.event_id    and od.bet_types_id_FK=bt.bet_types_id  and timeParam< b.end_date and b.bet_active <timeParam
    and   bt.event_bets_id_FK=eb.event_bets_id  ;
END$$

CREATE  PROCEDURE `userSelectBets`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT  bt.name as oddname,bt.odd_value as odd, b.bet_name as name ,b.end_date as dateinfo , b.bets_id as betId , c.count, e.event_name as eventname, bt.bet_types_id as betTypeId, e.event_id as eventId FROM events_table e,cont c, bets b, bets_type bt where c.bet_name=b.bet_name and b.groups_id_FK=primParam and bt.bets_id_FK=b.bets_id  and b.event_id_FK=e.event_id;
END$$

CREATE  PROCEDURE `userSelectEventGroup`(IN `primParam` int(11) unsigned , IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  select count(event_id) as num , et.event_id  as eventId,   et.event_name as name ,b.end_date as enddate, b.groups_id_FK as groupId from event_bets  eb
  inner join  bets b on b.bets_id=eb.bets_id_FK and b.groups_id_FK=primParam and b.bet_active<timeParam and  timeParam<b.end_date
  left join events_table et on et.event_id=eb.event_id_FK
  group by et.event_id;
END$$

CREATE  PROCEDURE `usertInsertBetType`(IN `primParam` int(11) unsigned , IN `bet_types_id_FKParam` int(11) unsigned ,in systemStatusParam int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  declare  oddParam int;
    select odd_value_id into oddParam from odd_value od  where od.bet_types_id_FK=bet_types_id_FKParam  order by od.odd_value_id desc   limit 1;
    insert into bets_type_has_bet_slip values (null, bet_types_id_FKParam ,primParam , oddParam,( select  bets_id_FK from event_bets where event_bets_id=(select event_bets_id_FK from bets_type where bet_types_id=bet_types_id_FKParam limit 1) limit 1 ) ,systemStatusParam ) ;
END$$

CREATE  PROCEDURE `usertSelectGroupAndSports`(IN `timeParam` datetime)
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  select sports_id as sportsId, name_of_sport as name from sports s ;
   select * from userselectactivegroups ;


  
END$$

CREATE  PROCEDURE `usertSelectMoney`(IN `primParam` int(11) unsigned )
    MODIFIES SQL DATA
    DETERMINISTIC
BEGIN
  SELECT  sum( (SELECT  sum(t.money) FROM transaction_in t where t.user_id_FK=primParam)-(SELECT  sum(b.money) FROM transaction_out b  where b.user_id_FK=primParam  )) as funds;
END$$

-- 
DELIMITER ;
-- 
