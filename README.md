Joomla! Ajax Interface
========
A slim, extensible component to act as an entry point for Ajax functionality in Joomla. It enables the ability to make requests to modules and plugins.

**VERSION NOTE:** Since it's inclusion in Joomla 3.2, this repository will only maintain a version of the component for Joomla 1.5 and 2.5.

Anatomy of an Ajax Request
==========================
**Required**

- `option=com_ajax`
- `[module|plugin]=name`

**Optional**

- `format=[json|debug]` defaults to raw if omitted.
- `method=[custom fragment]` defaults to `get` if omitted.

**Overview**

All requests begin with `?option=com_ajax`, which calls this extension, and must indicate the type of extension to call, and the data format to be returned.

Additional variables and values used by your extension may also be included in the URL.

For example, a request to `?option=com_ajax&module=session` would call `mod_session` with results returned in the default format. In contrast,`?option=com_ajax&plugin=session&format=json` would trigger the `onAjaxSession` plugin group with results returned in JSON.

Module Support
---------------
**Summary**

Module support is accomplished by calling a method in the module's `helper.php` file.

**Details**

Module requests must include the `module` variable in the URL, paired with the name of the module (i.e. `module=session` for `mod_session`).

This value is also used for:
- The name of the directory to check for the helper file, e.g. `/modules/mod_session/helper.php`
- The class name to call, e.g. `modSessionHelper`

Optionally, the `method` variable may be included to override the default method prefix of `get`. 

NOTE: All methods must end in `Ajax`. For example, `method=mySuperAwesomeMethodToTrigger` will call `mySuperAwesomeMethodToTriggerAjax`

The [Ajax Session Module](https://github.com/Joomla-Ajax-Interface/Ajax-Session-Module) is an example module that demonstrates this functionality.

Plugin Response
---------------
**Summary**

Plugin support is accomplished by triggering the `onAjax[Name]` plugin event.

**Details**

Plugin requests must include the `plugin` variable in the URL, paired with the name of the plugin event, e.g. `plugin=session` for `onAjaxSession`.

This value is also used for:
- The plugin class name following the `plgAjax[Name]` convention.
- The plugin function name following the `onAjax[Name]` convention.


The [Ajax Session Plugin](https://github.com/Joomla-Ajax-Interface/Ajax-Session-Plugin) is an example plugin that demonstrates this functionality.

Response Format
---------------
`format=[json|debug]` is an optional argument for the results format:
- `json` for JSON format
- `debug` for human-readable output of the results.

Stable Master Branch Policy
====================
The master branch will, at all times, remain stable. Development for new features will occur in branches, and when ready, will be merged into the master branch.

In the event features have already been merged for the next release series, and an issue arises that warrants a fix on the current release series, the developer will create a branch based off the tag created from the previous release, make the necessary changes, package a new release, and tag the new release. If necessary, the commits made in the temporary branch will be merged into master.

Branch Schema
==============
Shocking as it may seem, the goal is to also support Joomla 1.5. Therefore, the following branch schema will be followed:
* __master__ :  stable at all times, containing the latest tagged release for Joomla 1.5 and 2.5.
* __develop__: the latest version in development for Joomla 1.5 and 2.5. This is the branch to base all pull requests for Joomla 2.5 on.

Contributing
====================
Your contributions are more than welcome! Please make all pull requests against the corresponding `develop` branch.