<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'router' => array(
        'routes' => array(
          
             'gol-search' => array(
                'type' => 'Literal',
                
                'options' => array(       
                    'route' => '/search',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Search',
                        'action' => 'module',
                    ),
                ),
                'priority' => 1,
                'may_terminate' => true,
                'child_routes' => array(
                    'tag' => array(
                         'type' =>  'Segment',
                       'options' => array( 
                       
                        'route' => '/tag[/:query]',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Search',
                            'action' => 'tag',
                        ),
                    ),
                        ),
                    'tagajax' => array(
                        'type' =>  'segment',
                        'options' => array(
                        'route' => '/tag-ajax[/:query]',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Search',
                            'action' => 'tagAjax',
                        ),
                    ),
                        ),
                    'module' => array(
                        'type' =>  'segment',
                        'options' => array(
                        'route' => '/module[/:query]',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Search',
                            'action' => 'module',
                        ),
                            ),
                    ),
                    'module-ajax' => array(
                        'type' =>  'segment',
                        'options' => array(
                        'route' => '/module-ajax[/:query]',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Search',
                            'action' => 'moduleAjax',
                        ),
                    ),
                        ),
                ),
            ),
            'home' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[page/:page]',
                    'constraints' => array(
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
                'priority' => 1,
                'may_terminate' => true,
                'child_routes' => array(
                    'query' => array(
                        'type' => 'Query',
                    ),
                )
            ),
            'feed' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/feed',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'feed',
                    ),
                ),
            ),
         
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
        
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Search' => 'Application\Controller\SearchController',
        ),
        'aliases' => array(
            'search-controller' => 'Application\Controller\Search'
        ),
        'factories' => array(
        
           )
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
        'aliases' => array(
            'Application\Controller\SearchController' => 'Application\Controller\SearchController'
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                __DIR__ . '/../public',
            ),
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/error' => __DIR__ . '/../view/layout/layout-small-header.phtml',
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'application/index/pagination' => __DIR__ . '/../view/application/index/pagination.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
            'application/helper/new-modules' => __DIR__ . '/../view/application/helper/new-modules.phtml',
            'application/search/index' => __DIR__ . '/../view/application/search/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewFeedStrategy',
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'flashMessenger' => function($sm) {
                $sm = $sm->getServiceLocator();
                $plugin = $sm->get('ControllerPluginManager')->get('flashMessenger');

                $helper = new Application\View\Helper\FlashMessenger($plugin);
                return $helper;
            }
        )
    ),
);
