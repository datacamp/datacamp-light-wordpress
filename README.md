# datacamp-light-wordpress
A Wordpress plugin that allows easy integration of DataCamp Light exercises into pages and posts.

## Installation Instructions

To install the Plugin you have to place the Plugin files in the Plugin folder of your WordPress installation. It is recommended that you download [the latest release](../../releases/latest) but you can also use the possibly unstable [development version](../../archive/master.zip). 

The Wordpress Plugin folder can be found at `wp-content/plugins` in your WordPress directory. Simply place the extracted folder there (`wp-content/plugins/datacamp-light-wordpress-x.x.x`) and your WordPress installation will automatically detect the plugin and list it in your administration dashboard, where you can activate it. For more information on manually installing a WordPress plugin visit https://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation.


## Example Usage

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
