<?php
/**
 * User: Abu Kahab Mohammad Nahid Hossain
 * Email: mail@akmnahid.com
 * Web: www.akmnahid.com
 * Date: 2018/08/09
 * Time: 11:04 AM
 */
require_once "configuration.php";

if(isset($_GET["name"],$_GET["security"],$deployments[$_GET["name"]])){

    $deployment = $deployments[$_GET["name"]];
    if($deployment["security"] ==$_GET["security"]){
        //change directory to deployment directory
        chdir($deployment["dir"]);
        $track_file_change = null;
        if(count($deployments["post_deployment_commands_file_changed"])>0){
            foreach ($deployments["post_deployment_commands_file_changed"] as $key => $actions){
                $actions["hash"]=md5_file($actions["file"]);
                $track_file_change[$key]= $actions;
            }
        }
        if($deployment["delete_before_deployment"] === true){
            echo "Running command: "."rm -rf ./*\n";
            echo shell_exec("rm -rf ./*");
            echo "\n";
        }
        elseif (count($deployment["delete_files"])>0){
            foreach ($deployment["delete_files"] as $delete_file){
                echo "Running command: "."rm -rf ".$delete_file."\n";
                echo shell_exec("rm -rf ".$delete_file);
            }
        }

        //deploy to the directory
        if($deployment["delete_before_deployment"] === true){
            $command = "git clone ".$deployment["repo"];
            if($deployment["branch"] != null){
                $command.=" -b ".$deployment["branch"];
            }
            echo "Running command: ".$command."\n";
            echo shell_exec($command);
            echo "\n";
        }
        else{
            echo "Running command: git pull\n";
            echo shell_exec("git pull");
            echo "\n";
        }
        if($track_file_change != null){
            foreach ($track_file_change as $actions){
                if(md5_file($actions["file"]) !=$actions["hash"]){
                    foreach ($actions["commands"] as $command){
                        echo "Running command: ".$command."\n";
                        echo shell_exec($command);
                        echo "\n";
                    }
                }
            }
        }
        foreach ($deployment["post_deployment_commands"] as $deployment_command){
            echo "Running command: ".$deployment_command."\n";
            echo shell_exec($deployment_command);
            echo "\n";
        }

    }
    else echo "Invalid Security Code\n";

}
else echo "Deployment Name Not Set\n";
