<?php
    class Template
    {
        //Get file content (from "$file_name")
        function get_file_content($file_name){
            if (file_exists($file_name)) {
                $content = file_get_contents($file_name);
            } else {
                $content = "Tried to open the file: \"$file_name\", but I can't find it!";
            }
            return $content;
        }

        //Replace all matching placeholders in content with corresponding data values from array
        function parse($template_content, $placeholder_data){
            foreach ($placeholder_data as $placeholder_key => $placeholder_value) {
                $template_content = str_replace("##$placeholder_key##", $placeholder_value, $template_content);
            }
            return $template_content;
        }
    }
?>