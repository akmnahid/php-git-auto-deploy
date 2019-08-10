<?php
require_once "configuration.php";

if(isset($_GET["name"],$_GET["security"],$deployments[$_GET["name"]])){

    $deployment = $deployments[$_GET["name"]];
    if($deployment["security"] ==$_GET["security"]){
        //change directory to deployment directory
        chdir($deployment["dir"]);
        if($deployment["delete_before_deployment"] === true){
            echo shell_exec("rm -rf ./*");
            echo "\n";
        }
        elseif (count($deployment["delete_files"])>0){
            foreach ($deployment["delete_files"] as $delete_file){
                echo shell_exec("rm -rf ".$delete_file);
            }
        }

        //deploy to the directory
        if($deployment["delete_before_deployment"] === true){
            $command = "git clone ".$deployment["repo"];
            if($deployment["branch"] != null){
                $command.=" -b ".$deployment["branch"];
            }
            echo shell_exec($command);
            echo "\n";
        }
        //post deployment commands
        foreach ($deployment["post_deployment_commands"] as $deployment_command){
            echo shell_exec($deployment_command);
            echo "\n";
        }

    }
    else echo "Invalid Security Code\n";

}
else echo "Deployment Name Not Set\n";
