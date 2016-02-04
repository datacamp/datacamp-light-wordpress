[![DataCamp Light banner](http://assets.datacamp.com/img/github/datacamp-light/bannerv3.1.png "Banner")](http://assets.datacamp.com/example/standalone-two-consoles.html)

# DataCamp Light Wordpress Plugin
A Wordpress Plugin that allows easy integration of the DataCamp Light interactive learning widget into posts and pages.

## Installation Instructions

### Administration Dashboard (Recommended)

To install the Plugin using the Wordpress Administration Dashboard first download the zip folder containing the Plugin to your computer. It is recommended that you download [the latest release](../../releases/latest) but you can also use the possibly unstable [development version](../../archive/master.zip).

Next, go to your Wordpress Administration Dashboard and look for the Plugin section in the menu on the left side. Once opened click on "Add New".

![Installation Instruction 1](http://assets.datacamp.com/img/github/datacamp-light-wordpress/installation_1.png "Installation Instruction 1")

At the top of the page you can now click the "Upload Plugin" button.

![Installation Instruction 2](http://assets.datacamp.com/img/github/datacamp-light-wordpress/installation_2.png "Installation Instruction 2")

Now open the file browser and look for the downloaded zip file containing the plugin. If done correctly the page should look like the screenshot below (with possibly a different version number). Click "Install Now".

![Installation Instruction 3](http://assets.datacamp.com/img/github/datacamp-light-wordpress/installation_3.png "Installation Instruction 3")

Congratulations! You've successfully installed the Plugin. You can now activate it.

![Installation Instruction 4](http://assets.datacamp.com/img/github/datacamp-light-wordpress/installation_4.png "Installation Instruction 4")

### FTP (Advanced)

To install the Plugin using FTP you have to place the Plugin files in the Plugin folder of your WordPress installation. It is recommended that you download [the latest release](../../releases/latest) but you can also use the possibly unstable [development version](../../archive/master.zip). 

The Wordpress Plugin folder can be found at `wp-content/plugins` in your WordPress directory. Simply place the extracted folder there (`wp-content/plugins/datacamp-light-wordpress-x.x.x`) and your WordPress installation will automatically detect the plugin and list it in your administration dashboard, where you can activate it. For more information on manually installing a WordPress plugin visit https://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation.

## Usage

It is recommended that you use the Text version of the WordPress editor while making use of this plugin. 

```
[datacamp_exercise lang="python"]
  [datacamp_sample_code]
    # Create a variable a, equal to 5


    # Print out a


  [/datacamp_sample_code]
  [datacamp_pre_exercise_code]
    # No PEC
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
