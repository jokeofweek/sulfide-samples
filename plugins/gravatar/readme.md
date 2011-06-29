# Gravatar Plugin

The gravatar plugin allows you to interact with the Gravatar API through a variety of controllers

## Installing
1.  Pull the latest version of sulfide-samples
2.  Copy all the files/directories in the /plugins/gravatar folder to your application's /plugins directory

## Using the Plugin

The first step to using the plugin is to load it into the PluginManager. In order to do this, you must add the following line in the index.php file:

    Plugins::load('gravatar');

The plugin allows you to fetch the avatar associated with a given email address through the following url:

	http://[path-to-application]/gravatar/image/[email-address]

This is a valid link to an image, and can be used in `<img>` tags. Note that you may also specify a size for the image as an extra parameter. The size should be a number between 1 and 512, denoting the height and width in pixels. This can be done through the following url:

	http://[path-to-application]/gravatar/image/[email-address]/[size]
	
The plugin also allows you to fetch profile information for a given user. You may fetch the profile information associated with a given e-mail in JSON format through the following url:

	http://[path-to-application]/gravatar/profile/[email-address]
	
The profile information can be returned in a variety of formats, including:

* JSON -> json
* XML -> xml
* vCard -> vcf
* QR Image -> qr

To specify the format, add the format's code (for example, vCard's format code is vcf) at the end of the url. An example of this is:

	http://[path-to-application]/gravatar/profile/[email-address]/xml
	
## Notes
* Sulfide version used: [commit 837095e7c9edbe461ede2a7c76ec0ff160acffe5](https://github.com/jokeofweek/sulfide/commit/837095e7c9edbe461ede2a7c76ec0ff160acffe5 "Sulfide Version")