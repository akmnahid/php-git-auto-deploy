<?php


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