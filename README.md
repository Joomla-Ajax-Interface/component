Joomla! Ajax Interface
========
A slim, extensible component to act as an entry point for Ajax functionality in Joomla. It is designed to execute plugins following the onAjax[foo] naming convention, where [foo] is the name of the Ajax plugin group to execute. For example, the [Ajax Session Plugin](https://github.com/betweenbrain/Ajax-Session-Plugin) is executed by the component calling  onAjaxSession as the plugin extends `JPlugin` with `plgAjaxSession`.

URL Convention
==============
Executing a ajax plugin is done by submitting a request to `index.php?option=com_ajax&group=foo&variable=value&format=json` where:
    * `index.php?option=com_ajax` calls the extension.
    * `group=foo` where `foo` is the Ajax plugin group to execute (i.e. onAjaxFoo).
    * `variable=value` is any variable that your plugin is getting the value of.
    * `format=json` is an option argument to have the results of the executed plugin group echoed in JSON format.<br/>
     **NOTE**: Omitting the `format` variable will default to a raw output.

The [Ajax Session Module](https://github.com/betweenbrain/Ajax-Session-Module) is an example module to demonstrate interacting with the component and [Ajax Session Plugin](https://github.com/betweenbrain/Ajax-Session-Plugin)

Stable Master Branch Policy
====================
The master branch will, at all times, remain stable. Development for new features will occur in branches, and when ready, will be merged into the master branch.

In the event features have already been merged for the next release series, and an issue arises that warrants a fix on the current release series, the developer will create a branch based off the tag created from the previous release, make the necessary changes, package a new release, and tag the new release. If necessary, the commits made in the temporary branch will be merged into master

Contributing
====================
Your contributions are more than welcome! Please make all pull requests against the [develop](https://github.com/betweenbrain/Joomla-Ajax-Interface/tree/develop) branch for Joomla version 2.5+ and [1.5-develop](https://github.com/betweenbrain/Joomla-Ajax-Interface/tree/1.5-develop) for Joomla version 1.5.