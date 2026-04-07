CREATE TABLE tx_msfeatures_domain_model_feature (
    title varchar(255) DEFAULT '' NOT NULL,
    subtitle varchar(255) DEFAULT '' NOT NULL,
    perex text,
    description mediumtext,
    images int(11) DEFAULT '0' NOT NULL,
    top tinyint(1) DEFAULT '0' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,
    KEY sorting (sorting),
    KEY top (top)
);
