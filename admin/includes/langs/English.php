<?php

    function lang($pharse)
    {
        static $lang = array(
            // Navbar 
            "HOME" => "home",
            "CATEGORIES" => "categories",
            "ITEMS" => "Items",
            "MEMBERS" => "members",
            "STATISTICS" => "statistics",
            "LOGS" => "logs",
            "LOGOUT" => "logout",
            "EDIT_PROFILE" => "Edit",
            "SETTING" => "setting",
            // update form
            "EDITPROFILE" => "Edit profile",
            "USERNAME" => "username",
            "PASSWORD" => "password",
            "EMAIL" => "Email",
            "FULLNAME" => "Full name",
            // add form
            "ADD_NEW_MEMBER" => "Add new Member",
            // manger
            "MEMBERS" => "MemberManagement",
            //table
            "DATE" => "Date Register",
            "CONTROL" => "control",
            "USERID" => "UserID",
            "NEW_MEMBER" => "New Member",
            "ACTIVE_MEMBER" => "Active Member",
            "PENDDING_MEMBER" => "Pendding Member",
            // Add New Member
            "ADD_NEW_ITEM" => "Add New Item",
            "NAME" => "Name",
            "DES" => "Description",
            "ORDERING" => "Ordering",
            "VISIBILTY" => "Visibilty",
            "A_COMMENT" => "Allow Comments",
            "A_ADS" => "Allow ADS"
        );

        return $lang[$pharse];
    }

?>