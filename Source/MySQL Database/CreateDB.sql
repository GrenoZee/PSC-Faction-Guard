-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 23, 2017 at 01:17 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `faction_guard`
--

-- --------------------------------------------------------

--
-- Table structure for table `APISession`
--

CREATE TABLE `APISession` (
  `ID` int(10) UNSIGNED NOT NULL,
  `User_ID` int(10) UNSIGNED NOT NULL COMMENT 'Foreign key to the user',
  `Token` varchar(36) COLLATE utf16_unicode_ci NOT NULL,
  `Expiry` int(10) UNSIGNED NOT NULL COMMENT 'Unix timestamp of the token expiry'
) ENGINE=MyISAM DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Commander`
--

CREATE TABLE `Commander` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(50) COLLATE utf16_unicode_ci NOT NULL,
  `Group_ID` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `CommanderGroup`
--

CREATE TABLE `CommanderGroup` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(100) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `access_token` varchar(40) COLLATE utf16_unicode_ci NOT NULL,
  `client_id` varchar(80) COLLATE utf16_unicode_ci NOT NULL,
  `user_id` varchar(80) COLLATE utf16_unicode_ci DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) COLLATE utf16_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_authorization_codes`
--

CREATE TABLE `oauth_authorization_codes` (
  `authorization_code` varchar(40) COLLATE utf16_unicode_ci NOT NULL,
  `client_id` varchar(80) COLLATE utf16_unicode_ci NOT NULL,
  `user_id` varchar(80) COLLATE utf16_unicode_ci DEFAULT NULL,
  `redirect_uri` varchar(2000) COLLATE utf16_unicode_ci DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) COLLATE utf16_unicode_ci DEFAULT NULL,
  `id_token` varchar(1000) COLLATE utf16_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `client_id` varchar(80) COLLATE utf16_unicode_ci NOT NULL,
  `client_secret` varchar(80) COLLATE utf16_unicode_ci DEFAULT NULL,
  `redirect_uri` varchar(2000) COLLATE utf16_unicode_ci DEFAULT NULL,
  `grant_types` varchar(80) COLLATE utf16_unicode_ci DEFAULT NULL,
  `scope` varchar(4000) COLLATE utf16_unicode_ci DEFAULT NULL,
  `user_id` varchar(80) COLLATE utf16_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_jwt`
--

CREATE TABLE `oauth_jwt` (
  `client_id` varchar(80) COLLATE utf16_unicode_ci NOT NULL,
  `subject` varchar(80) COLLATE utf16_unicode_ci DEFAULT NULL,
  `public_key` varchar(2000) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `refresh_token` varchar(40) COLLATE utf16_unicode_ci NOT NULL,
  `client_id` varchar(80) COLLATE utf16_unicode_ci NOT NULL,
  `user_id` varchar(80) COLLATE utf16_unicode_ci DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) COLLATE utf16_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_scopes`
--

CREATE TABLE `oauth_scopes` (
  `scope` varchar(80) COLLATE utf16_unicode_ci NOT NULL,
  `is_default` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_users`
--

CREATE TABLE `oauth_users` (
  `username` varchar(80) COLLATE utf16_unicode_ci DEFAULT NULL,
  `password` varchar(80) COLLATE utf16_unicode_ci DEFAULT NULL,
  `first_name` varchar(80) COLLATE utf16_unicode_ci DEFAULT NULL,
  `last_name` varchar(80) COLLATE utf16_unicode_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf16_unicode_ci DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT NULL,
  `scope` varchar(4000) COLLATE utf16_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Username` varchar(50) COLLATE utf16_unicode_ci NOT NULL,
  `PasswordHash` varchar(100) COLLATE utf16_unicode_ci NOT NULL,
  `Commander_ID` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `APISession`
--
ALTER TABLE `APISession`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `IX_APISession_Token_Unique` (`Token`),
  ADD KEY `IX_APISession_Expiry` (`Expiry`);

--
-- Indexes for table `Commander`
--
ALTER TABLE `Commander`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `IX_Commander_Name_Unique` (`Name`) USING BTREE;

--
-- Indexes for table `CommanderGroup`
--
ALTER TABLE `CommanderGroup`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `IX_CommanderGroup_Name_Unique` (`Name`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`access_token`);

--
-- Indexes for table `oauth_authorization_codes`
--
ALTER TABLE `oauth_authorization_codes`
  ADD PRIMARY KEY (`authorization_code`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`refresh_token`);

--
-- Indexes for table `oauth_scopes`
--
ALTER TABLE `oauth_scopes`
  ADD PRIMARY KEY (`scope`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `IX_User_Username_Unique` (`Username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `APISession`
--
ALTER TABLE `APISession`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Commander`
--
ALTER TABLE `Commander`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `CommanderGroup`
--
ALTER TABLE `CommanderGroup`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;