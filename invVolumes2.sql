DROP TABLE IF EXISTS `invVolumes`;
CREATE TABLE `invVolumes` (
  `typeid` int(11) NOT NULL,
  `volume` int(11) DEFAULT NULL,
  PRIMARY KEY (`typeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into invVolumes (typeid,volume)  select typeid,  2500 from invTypes where groupid=324 ;
insert into invVolumes (typeid,volume)  select typeid,  15000 from invTypes where groupid=1201 ;
insert into invVolumes (typeid,volume)  select typeid,  15000 from invTypes where groupid=27 ;
insert into invVolumes (typeid,volume)  select typeid,  50000 from invTypes where groupid=419 ;
insert into invVolumes (typeid,volume)  select typeid,  50000 from invTypes where groupid=898 ;
insert into invVolumes (typeid,volume)  select typeid,  20000 from invTypes where groupid=1202 ;
insert into invVolumes (typeid,volume)  select typeid,  1300000 from invTypes where groupid=883 ;
insert into invVolumes (typeid,volume)  select typeid,  500 from invTypes where groupid=29 ;
insert into invVolumes (typeid,volume)  select typeid,  1300000 from invTypes where groupid=547 ;
insert into invVolumes (typeid,volume)  select typeid,  10000 from invTypes where groupid=906 ;
insert into invVolumes (typeid,volume)  select typeid,  15000 from invTypes where groupid=540 ;
insert into invVolumes (typeid,volume)  select typeid,  2500 from invTypes where groupid=830 ;
insert into invVolumes (typeid,volume)  select typeid,  10000 from invTypes where groupid=26 ;
insert into invVolumes (typeid,volume)  select typeid,  5000 from invTypes where groupid=420 ;
insert into invVolumes (typeid,volume)  select typeid,  1300000 from invTypes where groupid=485 ;
insert into invVolumes (typeid,volume)  select typeid,  2500 from invTypes where groupid=893 ;
insert into invVolumes (typeid,volume)  select typeid,  50000 from invTypes where groupid=381 ;
insert into invVolumes (typeid,volume)  select typeid,  3750 from invTypes where groupid=543 ;
insert into invVolumes (typeid,volume)  select typeid,  2500 from invTypes where groupid=1283 ;
insert into invVolumes (typeid,volume)  select typeid,  10000 from invTypes where groupid=833 ;
insert into invVolumes (typeid,volume)  select typeid,  1300000 from invTypes where groupid=513 ;
insert into invVolumes (typeid,volume)  select typeid,  2500 from invTypes where groupid=25 ;
insert into invVolumes (typeid,volume)  select typeid,  10000 from invTypes where groupid=358 ;
insert into invVolumes (typeid,volume)  select typeid,  10000 from invTypes where groupid=894 ;
insert into invVolumes (typeid,volume)  select typeid,  20000 from invTypes where groupid=28 ;
insert into invVolumes (typeid,volume)  select typeid,  500000 from invTypes where groupid=941 ;
insert into invVolumes (typeid,volume)  select typeid,  2500 from invTypes where groupid=831 ;
insert into invVolumes (typeid,volume)  select typeid,  5000 from invTypes where groupid=541 ;
insert into invVolumes (typeid,volume)  select typeid,  1300000 from invTypes where groupid=902 ;
insert into invVolumes (typeid,volume)  select typeid,  10000 from invTypes where groupid=832 ;
insert into invVolumes (typeid,volume)  select typeid,  50000 from invTypes where groupid=900 ;
insert into invVolumes (typeid,volume)  select typeid,  3750 from invTypes where groupid=463 ;
insert into invVolumes (typeid,volume)  select typeid,  500 from invTypes where groupid=1022 ;
insert into invVolumes (typeid,volume)  select typeid,  2500 from invTypes where groupid=237 ;
insert into invVolumes (typeid,volume)  select typeid,  500 from invTypes where groupid=31 ;
insert into invVolumes (typeid,volume)  select typeid,  2500 from invTypes where groupid=834 ;
insert into invVolumes (typeid,volume)  select typeid,  5000 from invTypes where groupid=963 ;
insert into invVolumes (typeid,volume)  select typeid,  1300000 from invTypes where groupid=659 ;
insert into invVolumes (typeid,volume)  select typeid,  5000 from invTypes where groupid=1305 ;
insert into invVolumes (typeid,volume)  select typeid,  10000000 from invTypes where groupid=30 ;
insert into invVolumes (typeid,volume)  select typeid,  20000 from invTypes where groupid=380 ;

insert into invVolumes (volume,typeid)  values (300,11489);
insert into invVolumes (volume,typeid)  values (150,11488);
insert into invVolumes (volume,typeid)  values (65,3465);
insert into invVolumes (volume,typeid)  values (33,3466);
insert into invVolumes (volume,typeid)  values (10,3297);
insert into invVolumes (volume,typeid)  values (65,17365);
insert into invVolumes (volume,typeid)  values (33,17364);
insert into invVolumes (volume,typeid)  values (10,17363);
insert into invVolumes (volume,typeid)  values (2500,33003);
insert into invVolumes (volume,typeid)  values (1200,24445);
insert into invVolumes (volume,typeid)  values (5000,33005);
insert into invVolumes (volume,typeid)  values (1000,33007);
insert into invVolumes (volume,typeid)  values (500,33009);
insert into invVolumes (volume,typeid)  values (100,33011);
insert into invVolumes (volume,typeid)  values (65,3296);
insert into invVolumes (volume,typeid)  values (33,3293);
insert into invVolumes (volume,typeid)  values (10,3467);
insert into invVolumes (volume,typeid)  values (10000,17366);
insert into invVolumes (volume,typeid)  values (50000,17367);
insert into invVolumes (volume,typeid)  values (100000,17368);
