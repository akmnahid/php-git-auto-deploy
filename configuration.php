<?php
/**
 * User: Abu Kahab Mohammad Nahid Hossain
 * Email: mail@akmnahid.com
 * Web: www.akmnahid.com
 * Date: 2018/08/09
 * Time: 11:04 AM
 */

$deployments = [
    "name"=>[
        "security" => "",
        "dir"=>"",
        "repo"=>"",
        "branch" => null,
        "delete_before_deployment"=> false,
        "delete_files" =>[

        ],
        "post_deployment_commands" =>[

        ],
        "post_deployment_commands_file_changed"=>[
            [
                "install_npm"=>[
                    "file"=> "",
                    "commands"=>[]
                ]
            ]
        ]
    ]
];