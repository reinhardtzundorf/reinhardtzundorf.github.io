--
-- Database Structure               
-- =======================================================================================
--  group           :   member permissions, "Admin" & "Normal" for example. 
--                  :   future: this is where we differentiate for paid memberships.
--  member          :   base class for an account with login credentials on the site.
--  member_session  :   login timestamp log as well as saved sessions for members.
-- =======================================================================================

--
-- Database: `webfogpe_gfb`
--
CREATE DATABASE IF NOT EXISTS `webfogpe_gfb` 
DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `webfogpe_gfb`;

--
-- Table structure for table `group`
--
CREATE TABLE IF NOT EXISTS `group` 
(
  `gId`          INT(11)     NOT NULL   AUTO_INCREMENT,
  `gName`        VARCHAR(20) NOT NULL,
  `gPermissions` TEXT        NULL,
  PRIMARY KEY gPk_gId (`gId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;

--
-- Data for table `group`
--
INSERT INTO `group` (`gId`, `gName`, `gPermissions`) 
VALUES (1, 'Normal', ''), 
       (2, 'Admin', ''),
       (3, 'Super', '');

--
-- Table structure for table `member`
--
CREATE TABLE IF NOT EXISTS `member` 
(
  `mId`             INT(11)       NOT NULL    AUTO_INCREMENT,
  `mEmail`          VARCHAR(255)  NOT NULL,
  `mPassword`       VARCHAR(64)   NOT NULL,
  `mMobileNumber`   VARCHAR(12)   NULL,
  `mProfilePicURL`  VARCHAR(64)   NOT NULL,
  `mOrienDemo`      enum {'Gay/Bi', 'Lesbian', 'Transgender'} NOT NULL,
  `mAgeGroup`       enum {'18-25', '30-40', '45+'} NOT NULL,
  `mGeoLocation`    enum {'Southern Peninsula', 'Helderberg'},
  `mName`           VARCHAR(60)   NULL,
  `mGroup`          INT(11)       NOT NULL,
  `DateAdded`       TIMESTAMP     DEFAULT     CURRENT_TIMESTAMP,
  `DateModified`    TIMESTAMP     DEFAULT     CURRENT_TIMESTAMP,
  `DateRemoved`     TIMESTAMP     NULL,
  PRIMARY KEY mPk_mId (`mId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16;

--
-- Data for table `member`
--
INSERT INTO `member` (`mId`, `mName`, `mSurname`, `mEmail`, `mPassword`, `mGroup`) 
VALUES  (1, 'Reinhardt', 'Zundorf',  'reinhardt.zundorf@gmail.com', '16538xxr',  2);

--
-- Table structure for table `member_session`
--
CREATE TABLE IF NOT EXISTS `member_session` 
(
  `sId`     INT(11)        NOT NULL,
  `sHash`   VARCHAR(64)    NOT NULL,
  `mId`     INT(11)        NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;