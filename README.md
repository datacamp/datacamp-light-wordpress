# datacamp-light-wordpress
A Wordpress plugin for easily adding DataCamp-Light exercise.


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
