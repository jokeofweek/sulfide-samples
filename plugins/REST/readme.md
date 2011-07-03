# REST Plugin

The REST plugin provides a RESTController which supports REST request handling and routing.

## Installing
1.  Pull the latest version of sulfide-samples
2.  Copy all the files/directories in the /plugins/REST folder to your application's /plugins directory

## Using the Plugin

The first step to using the plugin is to load it into the PluginManager. In order to do this, you must add the following line in the index.php file:

    Plugins::load('REST');

After loading this plugin, you can now designate Controllers as REST Controllers by changing the Controller class header to
	
	class ControllerNameController extends RESTController
	
Once this is done, your class now supports REST requests. The RESTController modifies the standard action dispatching by prepending the action, so for example to handle a POST request to the action /clients, rather then creating a method called

	public function doClients
	
You would create one called

	public function doPostClients
	
This allows you to simply map request types to actions, and therefore to rapidly develop a RESTful API. Note that there are also two important configuration settings which can be overridden in your Controller. The first is _supportedMethods_, which designates all HTTP methods supported by this controller. The default declaration is

	protected $supportedMethods = array('DELETE', 'GET', 'POST', 'PUST');
	
Note that any request made to a method not included in this array will be forwarded to the _UnsupportedMethod_ action.

Another important setting is the _removeGetFromMethodName_, which allows you to modify the handling of GET requests so that they are dispatched to the standard, request-less action. As GET requests are so predominant, this is added as a convenience, and allows you to specify that a GET request for /products would invoke the _doProducts_ rather then the _doGetProducts_ method. The default declaration is
	
	protected $removeGetFromMethodName = FALSE;

## Notes
* Sulfide version used: [commit e4ede6d1a19c5c3786ff4ec71f56f6b4cc7ee205](https://github.com/jokeofweek/sulfide/commit/e4ede6d1a19c5c3786ff4ec71f56f6b4cc7ee205 "Sulfide Version")
