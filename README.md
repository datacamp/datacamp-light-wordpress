[![DataCamp Light banner](http://assets.datacamp.com/img/github/datacamp-light/bannerv3.1.png "Banner")](http://assets.datacamp.com/example/standalone-two-consoles.html)

# DataCamp Light Wordpress Plugin
A WordPress Plugin that allows easy integration of the DataCamp Light interactive learning widget into posts and pages.

## Installation Instructions

### Administration Dashboard (Recommended)

To install the Plugin using the Wordpress Administration Dashboard first download the zip folder containing the Plugin to your computer. It is recommended that you download [the latest release](../../releases/latest) but you can also use the possibly unstable [development version](../../archive/master.zip).

Next, go to your Wordpress Administration Dashboard and look for the Plugin section in the menu on the left side. Once opened click on "Add New".

![Installation Instruction 1](http://assets.datacamp.com/img/github/datacamp-light-wordpress/installation1.png "Installation Instruction 1")

At the top of the page you can now click the "Upload Plugin" button.

![Installation Instruction 2](http://assets.datacamp.com/img/github/datacamp-light-wordpress/installation2.png "Installation Instruction 2")

Now open the file browser and look for the downloaded zip file containing the plugin. If done correctly the page should look like the screenshot below (with possibly a different version number). Click "Install Now".

![Installation Instruction 3](http://assets.datacamp.com/img/github/datacamp-light-wordpress/installation3.png "Installation Instruction 3")

Congratulations! You've successfully installed the Plugin. You can now activate it.

![Installation Instruction 4](http://assets.datacamp.com/img/github/datacamp-light-wordpress/installation4.png "Installation Instruction 4")

### FTP (Advanced)

To install the Plugin using FTP you have to place the Plugin files in the Plugin folder of your WordPress installation. It is recommended that you download [the latest release](../../releases/latest) but you can also use the possibly unstable [development version](../../archive/master.zip). 

The Wordpress Plugin folder can be found at `wp-content/plugins` in your WordPress directory. Simply place the extracted folder there (`wp-content/plugins/datacamp-light-wordpress-x.x.x`) and your WordPress installation will automatically detect the Plugin and list it in your administration dashboard, where you can activate it. For more information on manually installing a WordPress plugin visit https://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation.

## Usage

The Plugin adds a media button "Add Exercise" to the interface where you create/edit posts and pages.

![Usage Add Button](http://assets.datacamp.com/img/github/datacamp-light-wordpress/usage_add_button.png "Usage Add Button")

Clicking this will result in a form being shown where you can pick the programming language for your exercise and fill in properties like the sample code and solution. 

![Usage Add Form](http://assets.datacamp.com/img/github/datacamp-light-wordpress/usage_add_form.png "Usage Add Form")

After clicking "Insert Exercise", the exercise information will be translated into WordPress shortcodes and inserted in the editor at the position of your cursor. If you would like to make changes to any of the properties, this can be done directly in the editor.

![Usage Add Shortcode](http://assets.datacamp.com/img/github/datacamp-light-wordpress/usage_add_shortcode.png "Usage Add Shortcode")

```Python
[datacamp_exercise lang="python" id="test1" show-run-button=TRUE]
  [datacamp_sample_code]
    # Create a variable a, equal to 5


    # Print out a


  [/datacamp_sample_code]
  [datacamp_pre_exercise_code]
    # This will get executed each time the exercise gets initialised
    b = 6
  [/datacamp_pre_exercise_code]
  [datacamp_solution]
    # Create a variable a, equal to 5
    a = 5

    # Print out a
    print(a)

  [/datacamp_solution]
  [datacamp_sct]
    test_object("a")
    test_function("print")
    success_msg("Great job!")
  [/datacamp_sct]
  [datacamp_hint]
    Use the assignment operator (<code><-</code>) to create the variable <code>a</code>.
  [/datacamp_hint]
[/datacamp_exercise]
```

You can now preview or publish your page or post! It is possible to embed multiple exercices in one post or page.

![Usage Add Result](http://assets.datacamp.com/img/github/datacamp-light-wordpress/usage_add_result.png "Usage Add Result")

### Note

It is recommended that you use the Text version of the WordPress editor while making use of this plugin. This can be set in the top right corner of the editor. If you make use extra whitespace or multiple empty lines somewhere in your exercise code, switching to the Visual editor might cause them to be replaced or disappear.

![Usage Text Editor](http://assets.datacamp.com/img/github/datacamp-light-wordpress/usage_text_editor.png "Usage Text Editor")
