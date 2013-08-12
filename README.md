Joomla! Ajax Interface
========
A slim, extensible component to act as an entry point for Ajax functionality in Joomla. It is designed to execute plugins following the onAjax[foo] naming convention, where [foo] is the name of the Ajax plugin group to execute. For example, the [Ajax Session Plugin](https://github.com/betweenbrain/Ajax-Session-Plugin) is executed by the component calling  onAjaxSession as the plugin extends `JPlugin` with `plgAjaxSession`.

URL Convention
==============
Ajax events are triggered by submitting a request to `index.php?option=com_ajax` where:

* `index.php?option=com_ajax` calls the extension.
* `plugin=foo` where `foo` is the Ajax plugin group to execute (i.e. onAjaxFoo).
* `module=foo` where `foo` is the name of the module of which you want to access the helper file of. Optionally pass values for the `helper` file, `class`, and `method` names.
* Include additional variables and values for your target component to use (i.e. `variable=value`).
* `format=json` is an option argument for JSON format and `format=debug` is an option argument for a basic human-readable format.<br/>
**NOTE**: Omitting the `format` variable will default to a raw output.

The [Ajax Session Module](https://github.com/betweenbrain/Ajax-Session-Module) is an example module to demonstrate interacting with the component and [Ajax Session Plugin](https://github.com/betweenbrain/Ajax-Session-Plugin)

Stable Master Branch Policy
====================
The master branch will, at all times, remain stable. Development for new features will occur in branches, and when ready, will be merged into the master branch.

In the event features have already been merged for the next release series, and an issue arises that warrants a fix on the current release series, the developer will create a branch based off the tag created from the previous release, make the necessary changes, package a new release, and tag the new release. If necessary, the commits made in the temporary branch will be merged into master.

Branch Schema
==============
Shocking as it may seem, my goal is to also support Joomla 1.5. Therefore, the following branch schema will be followed:
* __master__: stable at all times, containing the latest tagged release for Joomla 3.x+.
* __develop__: the latest version in development for Joomla 3.x+. This is the branch to base all pull requests for Joomla 2.5+ on.
* __2.5-master__: stable at all times, containing the latest tagged release for Joomla 2.5.
* __2.5-develop__: the latest version in development for Joomla 2.5. This is the branch to base all pull requests for Joomla 2.5 on.
* __1.5-master__: stable at all times, containing the latest tagged release for Joomla 1.5.
* __1.5-develop__: the latest version in development for Joomla 1.5. This is the branch to base all pull requests for Joomla 1.5 on.


Contributing
====================
Your contributions are more than welcome! Please make all pull requests against the [develop](https://github.com/betweenbrain/Joomla-Ajax-Interface/tree/develop) branch for Joomla version 2.5+ and [1.5-develop](https://github.com/betweenbrain/Joomla-Ajax-Interface/tree/1.5-develop) for Joomla version 1.5.
