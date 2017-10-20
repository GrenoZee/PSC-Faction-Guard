<?php
// Project
const FG_PROJECT_NAME = "PSC Faction Guard";

// Database
const FG_DB_SERVER = "127.0.0.1:8889";
const FG_DB_NAME = "faction_guard";
const FG_DB_USER = "FacGuard";
const FG_DB_PASSWORD = "notsureyet";

// Authentication
const FG_AUTH_TOKEN_VALID_PERIOD = 86640; //Validity of an access token in seconds 

//Response
const FG_RESPONSE_JSON = 'json';
const FG_RESPONSE_HTML = 'html';
        
        
//--------------------
// ERRORS
// No error
const FG_ERR_NONE = 0;

// Unknown errors
const FG_ERR_UNKNOWN = 1;

// API Calls errors
const FG_ERR_API_REQUEST_PARSING_ERROR = 1000;
const FG_ERR_API_NO_ACCESS_TOKEN = 1001;

// DB Errors
const FG_ERR_DB_CONNECTION_FAILED = 2000;

