#
# TABLE STRUCTURE FOR: migrations
#

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `migrations` (`version`) VALUES ('20160101000000');


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('1', '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, '1268889823', '1268889823', '1', 'Admin', 'istrator', 'ADMIN', '0');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('2', '127.0.0.1', 'admin', '$2y$08$5JbZbL5PGB514lsGKK.g6ewASSA0UMZDghbtIcWqU6ALf5rvyYdL2', '', 'admin@gmail.com', NULL, NULL, NULL, NULL, '1462880139', '1462880151', '1', 'Admin', 'Admin', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('3', '127.0.0.1', 'user_0', '$2y$08$455NWS6y1jGuvvgaYpWL9usYSZ/Gf91i.veTalsHNDnwMkPN/mxzu', '', 'user_0@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'admin_firstname_0', 'admin_name_0', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('4', '127.0.0.1', 'user_1', '$2y$08$RqUd1Lhjc.nDDtHkmfar/eKpOWkCxRWq99WVVnIjMVaeWy36.OP/O', '', 'user_1@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'user_0_firstname_1', 'user_0_name_1', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('5', '127.0.0.1', 'user_2', '$2y$08$IPo2b3LQFpToKQq9OLqwROcUjtmYDxqw5PdnUzV2kgxaGN5gXBI1a', '', 'user_2@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'user_1_firstname_2', 'user_1_name_2', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('6', '127.0.0.1', 'user_3', '$2y$08$E18NCD5KXnIoqRd6nSQuGuEEBNV5OOFbZ5i/iXEABKrwQFHl0XVIC', '', 'user_3@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'user_2_firstname_3', 'user_2_name_3', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('7', '127.0.0.1', 'user_4', '$2y$08$GjB3iQaF8AGSJ6.SFkBOS.4uYUWy3JF.2zWpyQBGueR1gAjRGjQBW', '', 'user_4@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'user_3_firstname_4', 'user_3_name_4', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('8', '127.0.0.1', 'user_5', '$2y$08$UqarYjBo7zxONfIGraznzeCNivaEJ8HZ4lfPdmCfDWev46hddddXC', '', 'user_5@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'user_4_firstname_5', 'user_4_name_5', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('9', '127.0.0.1', 'user_6', '$2y$08$FcitxfrHDmoNxNSEnsbK4.CrzANVV0RfJhp9BIqm5sviR8FJeT9am', '', 'user_6@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'user_5_firstname_6', 'user_5_name_6', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('10', '127.0.0.1', 'user_7', '$2y$08$lw97hY9aKcbZPFd6WQZoyu8Dw4uycBQPcRK23HKfQJdgUk6oucKWC', '', 'user_7@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'user_6_firstname_7', 'user_6_name_7', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('11', '127.0.0.1', 'user_8', '$2y$08$IS1bfPlCB6MJJ9wgUn4Cju31vAYuCoSfKDx6yK0tg7UDgXMon5oj6', '', 'user_8@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'user_7_firstname_8', 'user_7_name_8', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('12', '127.0.0.1', 'user_9', '$2y$08$p/MPBNht0.AS5I6cpXcyMeKwkv9gC6TQ5diL2TMAzKVTTFXlKX6/q', '', 'user_9@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'user_8_firstname_9', 'user_8_name_9', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('13', '127.0.0.1', 'user_10', '$2y$08$60DIsSMEPFaRDYZTBbzPmuP.mxfe82YCe6/I3WVL2mjZNSC9dAoOW', '', 'user_10@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'user_9_firstname_10', 'user_9_name_10', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('14', '127.0.0.1', 'user_11', '$2y$08$e5iy2Q669mx5RSBurXxjAeW0caX9HY/Jv3MGy6r5JN8kYYyp1Iaf6', '', 'user_11@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'user_10_firstname_11', 'user_10_name_11', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('15', '127.0.0.1', 'user_12', '$2y$08$499PuCjBBZtdAKM3cW9/G.XeUjp7KduAAlQ3Iiji1O.FLmeH/vaWu', '', 'user_12@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'user_11_firstname_12', 'user_11_name_12', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('16', '127.0.0.1', 'user_13', '$2y$08$RLUXY6LEGbTEVrPgU/M/hOP3ecLx.g3wZyelmKIGie6F/2zxTVe/2', '', 'user_13@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'user_12_firstname_13', 'user_12_name_13', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('17', '127.0.0.1', 'user_14', '$2y$08$Y5VGQJORwC.ixh1QhDV6hOcKiY6itoEKvPY8rQXiusKmPC3xNnury', '', 'user_14@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'user_13_firstname_14', 'user_13_name_14', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('18', '127.0.0.1', 'user_15', '$2y$08$oSf.hJh1P9zYrpSMNMxldeFIEiT8pPn/hF.tMS8n15rvfI9p/Gt0G', '', 'user_15@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'user_14_firstname_15', 'user_14_name_15', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('19', '127.0.0.1', 'user_16', '$2y$08$hWoAb/9.tFIvk2.jBrp91.yZts/alzLPVHZ.7QVLsTdvgpOJtloyC', '', 'user_16@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'user_15_firstname_16', 'user_15_name_16', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('20', '127.0.0.1', 'user_17', '$2y$08$g3SsmRSXn2HlXET/KbGaY.o1M56/PDx1LF1dS2mlHfW8LRHwoAgtm', '', 'user_17@gmail.com', NULL, NULL, NULL, NULL, '1462880139', NULL, '1', 'user_16_firstname_17', 'user_16_name_17', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('21', '127.0.0.1', 'user_18', '$2y$08$lC3L4rMVqK1xL9y2agBCvOHg2d9hUmPZHjyg9Q9KDWs8ZQzPvhhkm', '', 'user_18@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_17_firstname_18', 'user_17_name_18', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('22', '127.0.0.1', 'user_19', '$2y$08$lR4EUQ08YWPiNZAWm3IPL.7zEa8sUjjrido6.lEfPpMtjmpDZH4Cm', '', 'user_19@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_18_firstname_19', 'user_18_name_19', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('23', '127.0.0.1', 'user_20', '$2y$08$z3/PL1jqmjXQQCu03eHR6e6FOmaTOYphwBfZdJ90dQxZoXhV/UXva', '', 'user_20@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_19_firstname_20', 'user_19_name_20', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('24', '127.0.0.1', 'user_21', '$2y$08$ZsMi8pv3sBudVObASbQrBekct6LMUd0YYet8r3k7UwWUNUYFtqp8m', '', 'user_21@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_20_firstname_21', 'user_20_name_21', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('25', '127.0.0.1', 'user_22', '$2y$08$3a43SckNqg33lLjKLNhTAeR654KoYROwHYBtfQD9BW8tlRsgTIMXi', '', 'user_22@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_21_firstname_22', 'user_21_name_22', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('26', '127.0.0.1', 'user_23', '$2y$08$ImEoR2Qboyd3JjpWPQaF2eL.ApOAl8Gbw.jsIydXRPtPfcXEwsDoi', '', 'user_23@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_22_firstname_23', 'user_22_name_23', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('27', '127.0.0.1', 'user_24', '$2y$08$KUl14ZCNkdg2.DFuwXiEhO14NlB6XLNaAN6INDLJzC0bw14u12n5C', '', 'user_24@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_23_firstname_24', 'user_23_name_24', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('28', '127.0.0.1', 'user_25', '$2y$08$NPeENDDuSkVHGi6TtHxsauZcM6CS1f2dCDfbZ0b9eYQhdGfdhLfQi', '', 'user_25@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_24_firstname_25', 'user_24_name_25', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('29', '127.0.0.1', 'user_26', '$2y$08$qTtrLmDpTRncnbO./XcAjuBhjt54.5tNyakM6oDJxBG9Uev/UUvsW', '', 'user_26@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_25_firstname_26', 'user_25_name_26', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('30', '127.0.0.1', 'user_27', '$2y$08$.rXQjzdeD0r2xMpgnK97P.Qk00LNI1Huz6hDFAOYjvGbA.IYPk22y', '', 'user_27@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_26_firstname_27', 'user_26_name_27', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('31', '127.0.0.1', 'user_28', '$2y$08$iBP8jTIWr2PDDiViWjGQde5z53iU7EBnevBYMgpFCrQG4UPjgis6y', '', 'user_28@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_27_firstname_28', 'user_27_name_28', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('32', '127.0.0.1', 'user_29', '$2y$08$yANDt0dYBfbUI0jmGgeg1uHjYk2YdEy8qBJxKtnsmzh/trjirUcvy', '', 'user_29@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_28_firstname_29', 'user_28_name_29', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('33', '127.0.0.1', 'user_30', '$2y$08$emVjyuNflv5waOSS1b743OpggPeIpKGYlxcdu4gnJ/4EjEdVJoPPm', '', 'user_30@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_29_firstname_30', 'user_29_name_30', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('34', '127.0.0.1', 'user_31', '$2y$08$i39glFjJyVCDCwdK09mSt.uBsj8lpKVLs5ZnT4RCe/Yx3m981oSyS', '', 'user_31@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_30_firstname_31', 'user_30_name_31', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('35', '127.0.0.1', 'user_32', '$2y$08$CUB.nH0DuD4k6KpRhWdCq.tU6Eg67dpkKEfwzOFzQpawL7Uwyg3WO', '', 'user_32@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_31_firstname_32', 'user_31_name_32', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('36', '127.0.0.1', 'user_33', '$2y$08$3UkudmXCrcEuEhZPelcWjO2X7Vo7oHo8bcexY.00buYe8419oguTK', '', 'user_33@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_32_firstname_33', 'user_32_name_33', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('37', '127.0.0.1', 'user_34', '$2y$08$D.oyKmsqfizNupit5LrhyO6I1rAWUAD5Qq1tX.Vl4ojYrFdwvEhnu', '', 'user_34@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_33_firstname_34', 'user_33_name_34', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('38', '127.0.0.1', 'user_35', '$2y$08$SFQn4TK69fuErghcEzblYesVZf6hAQByNxLEL82Bd4bGyIyys7sYG', '', 'user_35@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_34_firstname_35', 'user_34_name_35', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('39', '127.0.0.1', 'user_36', '$2y$08$BQiIx8wuJT.c1hfKMIRPX.wsqwj9JdZRXtQ/yWSV0xeARw/tg1Ywu', '', 'user_36@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_35_firstname_36', 'user_35_name_36', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('40', '127.0.0.1', 'user_37', '$2y$08$71Rf7BXTAgx5La9Y0InlFuraQJXG7S0JLY7BEiTp4TLO7nwFuApDS', '', 'user_37@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_36_firstname_37', 'user_36_name_37', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('41', '127.0.0.1', 'user_38', '$2y$08$Xsw/cf1bDlGVmXpuq/3Vtus5N932uetjNGderQBvEiKhiUovm8XXK', '', 'user_38@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_37_firstname_38', 'user_37_name_38', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('42', '127.0.0.1', 'user_39', '$2y$08$.F.InENstNXlV37DCy.mpOK4DRfI9tFg5so1Om0fNdyMuKm2z8kdy', '', 'user_39@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_38_firstname_39', 'user_38_name_39', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('43', '127.0.0.1', 'user_40', '$2y$08$2Qq2gqIcUuEBshFUkLOH2.9KBp6AIFATIU.NwJyNy9ccAgxVpMW.a', '', 'user_40@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_39_firstname_40', 'user_39_name_40', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('44', '127.0.0.1', 'user_41', '$2y$08$aJMb0GxZESMzGb2WsLT5zufL9HiSyAPJI3remjEc5WNcNyeaa83qK', '', 'user_41@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_40_firstname_41', 'user_40_name_41', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('45', '127.0.0.1', 'user_42', '$2y$08$sOhooNg3zrgvlS1WXfRJrOOBcBU3oBqldAxzNNkGdv.dDn.3pWE7W', '', 'user_42@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_41_firstname_42', 'user_41_name_42', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('46', '127.0.0.1', 'user_43', '$2y$08$N84ZdyhmNieZeKkrKU4ltuAG24kU8na0ZE7XM1mU3ZwgLAkBXF47G', '', 'user_43@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_42_firstname_43', 'user_42_name_43', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('47', '127.0.0.1', 'user_44', '$2y$08$32xvZ6WRqKxp2881kVPKNexf94r5.lIvDokwACEqWDdHNYOiXfEiK', '', 'user_44@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_43_firstname_44', 'user_43_name_44', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('48', '127.0.0.1', 'user_45', '$2y$08$PxQfuittLKzzNDaRa8T8S.EA4dScAqkC5cUgn4qMSMyhTDqiMCxhK', '', 'user_45@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_44_firstname_45', 'user_44_name_45', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('49', '127.0.0.1', 'user_46', '$2y$08$QIi5VSchTMmd0Xg5ijEMUujZsMw386j8ra0JEkKpPDrM32ygq6loa', '', 'user_46@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_45_firstname_46', 'user_45_name_46', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('50', '127.0.0.1', 'user_47', '$2y$08$RE9UxHKOb8zZAr/1uSOrwelJbbXDb35y6wdFhlkR.kxeGNeT4ORZW', '', 'user_47@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_46_firstname_47', 'user_46_name_47', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('51', '127.0.0.1', 'user_48', '$2y$08$ix1fv/iu6wSwb/s7D9vk3.FQMscFVefdlwp9Ymwq5Cyhv1EYpsN4y', '', 'user_48@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_47_firstname_48', 'user_47_name_48', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('52', '127.0.0.1', 'user_49', '$2y$08$WJZXYyuq0vRweRLy0txeSetui2KA7rYdFaPbfwgOxXPq1DT612AdS', '', 'user_49@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_48_firstname_49', 'user_48_name_49', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('53', '127.0.0.1', 'user_50', '$2y$08$AKHzEIZl3e1MYJfqAdT/ZOLWE5tyuvmYoynu7D.XW.rY0RurN/O8e', '', 'user_50@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_49_firstname_50', 'user_49_name_50', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('54', '127.0.0.1', 'user_51', '$2y$08$S7k3hRdmrcMH33PLg/nP6O4e.Q4yUmtrGxFA/XJmRaspyi/g4RwVW', '', 'user_51@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_50_firstname_51', 'user_50_name_51', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('55', '127.0.0.1', 'user_52', '$2y$08$ebOOvS4FgCvar0t3vBxiRuAif8TyVrS6sIWLuViBN7m2FjgmYWWNm', '', 'user_52@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_51_firstname_52', 'user_51_name_52', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('56', '127.0.0.1', 'user_53', '$2y$08$7TTlsLhpupu4JKagDJndkuJmB2icfZaQlz9l9cqf8nzEIZTKO1Dim', '', 'user_53@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_52_firstname_53', 'user_52_name_53', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('57', '127.0.0.1', 'user_54', '$2y$08$vZU.IlerIctZrC1VW2BKduzAdAQafqI2sP.DlC9HHeUbYO9jOLDRC', '', 'user_54@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_53_firstname_54', 'user_53_name_54', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('58', '127.0.0.1', 'user_55', '$2y$08$2FG7YwsWSUBjbmT4y6ncfOOQMaMSPEwtyzAvNQM2Q46rKXJSbPwDG', '', 'user_55@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_54_firstname_55', 'user_54_name_55', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('59', '127.0.0.1', 'user_56', '$2y$08$D82vxr9qfybebs3qRMlDFetcCsKcnL3yx2IIWGF8kqF.lUE/BpWsO', '', 'user_56@gmail.com', NULL, NULL, NULL, NULL, '1462880140', NULL, '1', 'user_55_firstname_56', 'user_55_name_56', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('60', '127.0.0.1', 'user_57', '$2y$08$jP8j1vcMFiZUPai2ZnAR5urEYluY4ht5xcIvVjJz9wRc.t4b5B/rK', '', 'user_57@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_56_firstname_57', 'user_56_name_57', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('61', '127.0.0.1', 'user_58', '$2y$08$KOXSPPizj9Xtc64fGTaH.O84qzOpCUA0aZd.Y9rQ3xem6LfOk48sO', '', 'user_58@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_57_firstname_58', 'user_57_name_58', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('62', '127.0.0.1', 'user_59', '$2y$08$/IjPbOKNt20/dog1RpGd4eczWNL8OVUqdHzt2anboXvAgPDlsPAi6', '', 'user_59@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_58_firstname_59', 'user_58_name_59', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('63', '127.0.0.1', 'user_60', '$2y$08$PYW7UaHLYHMdhj.Gfossiu8lkYBTHI/iOiIKoFfjXgxF/tnrQj8Ka', '', 'user_60@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_59_firstname_60', 'user_59_name_60', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('64', '127.0.0.1', 'user_61', '$2y$08$x82.BM7hIqS3VyxkilMX0egi3ottXXhLhvWNA4WEdnEXYWjeXmxRK', '', 'user_61@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_60_firstname_61', 'user_60_name_61', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('65', '127.0.0.1', 'user_62', '$2y$08$1GRhlnQZM.q5RiConaYY4.yFMQ96u70xV5AsgFC7Ss4Zn5FRaf9TO', '', 'user_62@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_61_firstname_62', 'user_61_name_62', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('66', '127.0.0.1', 'user_63', '$2y$08$6TsENFMYK3TDFu5AVPrCyejx61.lj.CX0i.Fpns6KfnMlOs.ekBSe', '', 'user_63@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_62_firstname_63', 'user_62_name_63', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('67', '127.0.0.1', 'user_64', '$2y$08$.tjM5opHh8oyBOLcjXowVOex2.NrHObBfJQuZzS4rbVrcHjsvkgba', '', 'user_64@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_63_firstname_64', 'user_63_name_64', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('68', '127.0.0.1', 'user_65', '$2y$08$xPlWmTVPeHAFFfit60UYfO39gyUrWbtnD0gGHZOvleNvb21tcL/EK', '', 'user_65@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_64_firstname_65', 'user_64_name_65', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('69', '127.0.0.1', 'user_66', '$2y$08$xAYheRqWqRxT9KXHSxOdLOungnpSljFdZ06dcq8.1VSY1jkmKtLeW', '', 'user_66@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_65_firstname_66', 'user_65_name_66', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('70', '127.0.0.1', 'user_67', '$2y$08$NqFq1cu3uI7cuc7J3OaprOHjbxJ28cAZHpclb9FMit0SrGrZ0DmzC', '', 'user_67@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_66_firstname_67', 'user_66_name_67', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('71', '127.0.0.1', 'user_68', '$2y$08$1aejmvgqsiUxF0UOFLuoRu90vXC51579O7DcNG8kvyT905mSvAkFq', '', 'user_68@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_67_firstname_68', 'user_67_name_68', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('72', '127.0.0.1', 'user_69', '$2y$08$j1v2UaSc8wB8y0/IYhmrNOfZezQTVGjjomuDHCkFarKajv4TPGPUO', '', 'user_69@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_68_firstname_69', 'user_68_name_69', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('73', '127.0.0.1', 'user_70', '$2y$08$DpqUvgy3YLXrdS1QUKk7fut9yjmnPVutVnVhPA/0qkO9Nw/JItUK2', '', 'user_70@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_69_firstname_70', 'user_69_name_70', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('74', '127.0.0.1', 'user_71', '$2y$08$c27GhzYKU50jsHH3InnB8u679T0IzWk27S4xoanWBo4lxqCOF0i6q', '', 'user_71@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_70_firstname_71', 'user_70_name_71', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('75', '127.0.0.1', 'user_72', '$2y$08$B2O/iB3PAUquhWzwLCTR8up4vh.YC8L66azm9gfofWfnoI6IBtusm', '', 'user_72@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_71_firstname_72', 'user_71_name_72', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('76', '127.0.0.1', 'user_73', '$2y$08$X4r7JLLmqSX8ey9tPSkOFuQRYeRgL9G7n1vzP01ojM4/lXTh/nGgO', '', 'user_73@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_72_firstname_73', 'user_72_name_73', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('77', '127.0.0.1', 'user_74', '$2y$08$98ZQLaxcOTG.T/hustQNg.stBosQa6DPlXYa4eteUE8ma4JqnUgRm', '', 'user_74@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_73_firstname_74', 'user_73_name_74', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('78', '127.0.0.1', 'user_75', '$2y$08$a7OhWv3cE1DkytCeNY.DH.Z39nI423n6.1URw/D/APjMovCYw9kPO', '', 'user_75@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_74_firstname_75', 'user_74_name_75', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('79', '127.0.0.1', 'user_76', '$2y$08$DIjczapourRSouwpMnIOKuBfR2/TUJHRqkfwV3/TT9T8C9nPi769y', '', 'user_76@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_75_firstname_76', 'user_75_name_76', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('80', '127.0.0.1', 'user_77', '$2y$08$kGT2UXZ9lghXhBD9m4FmM.OiARKv4ZtNbqBv1vxc.cQJlVHHj0TEG', '', 'user_77@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_76_firstname_77', 'user_76_name_77', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('81', '127.0.0.1', 'user_78', '$2y$08$H4sXaUP.EpJyFloJFp617.jlI0Poc3D9FMlJiK/.HIVo4m/iaNGBS', '', 'user_78@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_77_firstname_78', 'user_77_name_78', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('82', '127.0.0.1', 'user_79', '$2y$08$Ox4z9ZRp/QdB9Vk1N0dkNOO72hVg.Ijk1L9kaJ6z4uItx2QtOYj2y', '', 'user_79@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_78_firstname_79', 'user_78_name_79', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('83', '127.0.0.1', 'user_80', '$2y$08$tuA0CoKFbtql4PYKpug1PuW7djn9TbZ4iB8NCgk8k/z0kkU6zSy2y', '', 'user_80@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_79_firstname_80', 'user_79_name_80', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('84', '127.0.0.1', 'user_81', '$2y$08$GFrB.Dld8KTonGmyFCvrvezVBvwTmeIhfMyR90KG6HYb/cpif6WnK', '', 'user_81@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_80_firstname_81', 'user_80_name_81', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('85', '127.0.0.1', 'user_82', '$2y$08$0R5g0X743xfx9zjfm4I9j.iuvi6aCgpOXI2Km5Nbu7SIpUFhJTSHO', '', 'user_82@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_81_firstname_82', 'user_81_name_82', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('86', '127.0.0.1', 'user_83', '$2y$08$1uvRa7pZUjYg2baTeRIjy.jPpaQfqLozNDQx8lbUxhwULIIpW24yG', '', 'user_83@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_82_firstname_83', 'user_82_name_83', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('87', '127.0.0.1', 'user_84', '$2y$08$MElNPcYF0iMDVFPcNcPONO8/9FIwltfzeq3n481ec89MC/zKHRKBy', '', 'user_84@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_83_firstname_84', 'user_83_name_84', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('88', '127.0.0.1', 'user_85', '$2y$08$1J5mLCwMG3nfXgPABjSZs.VgjLkcwEFRBavdD2mZdBeVUmrJSErKq', '', 'user_85@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_84_firstname_85', 'user_84_name_85', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('89', '127.0.0.1', 'user_86', '$2y$08$o0GehSHgonXDg8xalwoIuurFZ22gaToEhpnSy04K3gqSYGW/JrVdC', '', 'user_86@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_85_firstname_86', 'user_85_name_86', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('90', '127.0.0.1', 'user_87', '$2y$08$zodK02MPgsg5fEXUZflFku5FNG51ummM5HS9gE0Wh.8fJ4yf1C.Ce', '', 'user_87@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_86_firstname_87', 'user_86_name_87', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('91', '127.0.0.1', 'user_88', '$2y$08$/Xwuu5FOtjuIxtZ3tzEm8OJ.2.Hdmd2RRgeH6MAcOOrr44Umv923q', '', 'user_88@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_87_firstname_88', 'user_87_name_88', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('92', '127.0.0.1', 'user_89', '$2y$08$6WDYeN/U1xbMU23JeYbEQeAtSmkRfwNXYesSdhRNF8QI70AneepVG', '', 'user_89@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_88_firstname_89', 'user_88_name_89', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('93', '127.0.0.1', 'user_90', '$2y$08$9dczEWzWJ/KJ4u/Yrr2oGe6C0UWfL9CKII0OewJgIzzOtDOAWbgwy', '', 'user_90@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_89_firstname_90', 'user_89_name_90', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('94', '127.0.0.1', 'user_91', '$2y$08$8i.9dQOluSF5021pl3/tluGbeTPX2cCjYNrZuHaU55rX0B2wT/dZa', '', 'user_91@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_90_firstname_91', 'user_90_name_91', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('95', '127.0.0.1', 'user_92', '$2y$08$PEOHwYz/WWZCP1sIWVJTBexbz4kLqr0jrS8Ixvs4QvkqOpRmTni8m', '', 'user_92@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_91_firstname_92', 'user_91_name_92', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('96', '127.0.0.1', 'user_93', '$2y$08$TRagjbv0DjZOGb3imCV9Cu9q7sCGTUjfQ.123c4uvX.e3WEwTNQf2', '', 'user_93@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_92_firstname_93', 'user_92_name_93', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('97', '127.0.0.1', 'user_94', '$2y$08$SxFPZ.5.QbQghMS4e8X.9uHLMjFmZw0trZ5u5GxPSL9tiL0TcvS3S', '', 'user_94@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_93_firstname_94', 'user_93_name_94', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('98', '127.0.0.1', 'user_95', '$2y$08$PkK2MGCnAEAQXe216khdB.DDvbIUI91j8ZahAF4foZ9N15st3HFfa', '', 'user_95@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_94_firstname_95', 'user_94_name_95', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('99', '127.0.0.1', 'user_96', '$2y$08$oc3qZyFwkHtygGEe2Mp/3uJuPNH2F2SDaEyFOQ38CMDg8NccimjuW', '', 'user_96@gmail.com', NULL, NULL, NULL, NULL, '1462880141', NULL, '1', 'user_95_firstname_96', 'user_95_name_96', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('100', '127.0.0.1', 'user_97', '$2y$08$lbU11J9w6x1d8NI.I.QrHObHLs5/dYbBHCWzWQGsDpEkw8FLU00Ea', '', 'user_97@gmail.com', NULL, NULL, NULL, NULL, '1462880142', NULL, '1', 'user_96_firstname_97', 'user_96_name_97', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('101', '127.0.0.1', 'user_98', '$2y$08$FtLLHTzrKlc2cOCOTcZim.RbLIhiZ9VEo/3IG3m0lOgQqfHxOxxOC', '', 'user_98@gmail.com', NULL, NULL, NULL, NULL, '1462880142', NULL, '1', 'user_97_firstname_98', 'user_97_name_98', NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('102', '127.0.0.1', 'user_99', '$2y$08$9ITWiu8EOyJ2k.pdI25sDeIaLOB897RaWT9Qzy74qyqRpKdN56Bte', '', 'user_99@gmail.com', NULL, NULL, NULL, NULL, '1462880142', NULL, '1', 'user_98_firstname_99', 'user_98_name_99', NULL, NULL);


#
# TABLE STRUCTURE FOR: groups
#

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `groups` (`id`, `name`, `description`) VALUES ('1', 'admin', 'Administrator');
INSERT INTO `groups` (`id`, `name`, `description`) VALUES ('2', 'members', 'General User');


#
# TABLE STRUCTURE FOR: users_groups
#

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `users_groups_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `users_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('1', '1', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('2', '1', '2');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('3', '2', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('4', '3', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('5', '4', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('6', '5', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('7', '6', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('8', '7', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('9', '8', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('10', '9', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('11', '10', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('12', '11', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('13', '12', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('14', '13', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('15', '14', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('16', '15', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('17', '16', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('18', '17', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('19', '18', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('20', '19', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('21', '20', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('22', '21', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('23', '22', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('24', '23', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('25', '24', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('26', '25', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('27', '26', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('28', '27', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('29', '28', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('30', '29', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('31', '30', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('32', '31', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('33', '32', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('34', '33', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('35', '34', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('36', '35', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('37', '36', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('38', '37', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('39', '38', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('40', '39', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('41', '40', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('42', '41', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('43', '42', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('44', '43', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('45', '44', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('46', '45', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('47', '46', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('48', '47', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('49', '48', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('50', '49', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('51', '50', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('52', '51', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('53', '52', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('54', '53', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('55', '54', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('56', '55', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('57', '56', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('58', '57', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('59', '58', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('60', '59', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('61', '60', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('62', '61', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('63', '62', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('64', '63', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('65', '64', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('66', '65', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('67', '66', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('68', '67', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('69', '68', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('70', '69', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('71', '70', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('72', '71', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('73', '72', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('74', '73', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('75', '74', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('76', '75', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('77', '76', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('78', '77', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('79', '78', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('80', '79', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('81', '80', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('82', '81', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('83', '82', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('84', '83', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('85', '84', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('86', '85', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('87', '86', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('88', '87', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('89', '88', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('90', '89', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('91', '90', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('92', '91', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('93', '92', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('94', '93', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('95', '94', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('96', '95', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('97', '96', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('98', '97', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('99', '98', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('100', '99', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('101', '100', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('102', '101', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('103', '102', '1');


#
# TABLE STRUCTURE FOR: login_attempts
#

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: meta_test2
#

DROP TABLE IF EXISTS `meta_test2`;

CREATE TABLE `meta_test2` (
  `oaci` varchar(4) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`oaci`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `meta_test2` (`oaci`, `description`) VALUES ('LFOI', 'Abbeville');
INSERT INTO `meta_test2` (`oaci`, `description`) VALUES ('LFQB', 'Troyes');


#
# TABLE STRUCTURE FOR: meta_test1
#

DROP TABLE IF EXISTS `meta_test1`;

CREATE TABLE `meta_test1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `expiration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(4) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `epoch` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `oaci` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oaci` (`oaci`),
  CONSTRAINT `meta_test1_ibfk_1` FOREIGN KEY (`oaci`) REFERENCES `meta_test2` (`oaci`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: users_groups_view
#

CREATE ALGORITHM=UNDEFINED DEFINER=`ci3`@`localhost` SQL SECURITY DEFINER VIEW `users_groups_view` AS select `users`.`username` AS `username`,`groups`.`name` AS `groupname` from ((`users` join `users_groups`) join `groups`) where ((`users`.`id` = `users_groups`.`user_id`) and (`groups`.`id` = `users_groups`.`group_id`));

#
# TABLE STRUCTURE FOR: users_view
#

CREATE ALGORITHM=UNDEFINED DEFINER=`ci3`@`localhost` SQL SECURITY DEFINER VIEW `users_view` AS select `users`.`id` AS `id`,`users`.`ip_address` AS `ip_address`,`users`.`username` AS `username`,`users`.`password` AS `password`,`users`.`salt` AS `salt`,`users`.`email` AS `email`,`users`.`activation_code` AS `activation_code`,`users`.`forgotten_password_code` AS `forgotten_password_code`,`users`.`forgotten_password_time` AS `forgotten_password_time`,`users`.`remember_code` AS `remember_code`,`users`.`created_on` AS `created_on`,`users`.`last_login` AS `last_login`,`users`.`active` AS `active`,`users`.`first_name` AS `first_name`,`users`.`last_name` AS `last_name`,`users`.`company` AS `company`,`users`.`phone` AS `phone`,concat(`users`.`first_name`,' ',`users`.`last_name`) AS `image` from `users`;


