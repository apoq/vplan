<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1553094580.
 * Generated on 2019-03-20 16:09:40 by apoq
 */
class PropelMigration_1553094580
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `vp_days`
(
    `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `plan_id` bigint(15) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `plan_id` (`plan_id`),
    CONSTRAINT `vp_days_ibfk_1`
        FOREIGN KEY (`plan_id`)
        REFERENCES `vp_plans` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `vp_exercises`
(
    `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `day_id` bigint(15) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `day_id` (`day_id`),
    CONSTRAINT `vp_exercises_ibfk_1`
        FOREIGN KEY (`day_id`)
        REFERENCES `vp_days` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `vp_plans`
(
    `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `user_id` int(11) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `user_id` (`user_id`),
    CONSTRAINT `vp_plans_ibfk_1`
        FOREIGN KEY (`user_id`)
        REFERENCES `vp_users` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `vp_users`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(32) NOT NULL,
    `last_name` VARCHAR(32) NOT NULL,
    `email` VARCHAR(64) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `vp_days`;

DROP TABLE IF EXISTS `vp_exercises`;

DROP TABLE IF EXISTS `vp_plans`;

DROP TABLE IF EXISTS `vp_users`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}