<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
use App\Controllers\Accueil;
//$routes->get('/', 'Accueil::afficher');
$routes->get('/', [Accueil::class, 'afficher']);
//$routes->get('accueil/afficher/(:segment)', [Accueil::class, 'afficher']);

use App\Controllers\Compte;

$routes->get('compte/lister', [Compte::class, 'lister']);
$routes->get('compte/creer', [Compte::class, 'creer']);
$routes->post('compte/creer', [Compte::class, 'creer']);
$routes->get('compte/connecter', [Compte::class, 'connecter']);
$routes->post('compte/connecter', [Compte::class, 'connecter']);
$routes->get('compte/deconnecter', [Compte::class, 'deconnecter']);
$routes->get('compte/afficher_profil', [Compte::class, 'afficher_profil']);
$routes->get('compte/compte_modifier_mot_de_passe', [Compte::class, 'modifier_mot_de_passe']);
$routes->post('compte/compte_modifier_mot_de_passe', [Compte::class, 'modifier_mot_de_passe']);
$routes->get('compte/compte_tableau_comptes', [Compte::class, 'afficher_comptes']);





use App\Controllers\Actualite;
$routes->get('actualite/afficher', [Actualite::class, 'afficher']);
$routes->get('actualite/afficher/(:num)', [Actualite::class, 'afficher']);



use App\Controllers\Scenario;
$routes->get('scenario/jouer', [Scenario::class, 'jouer']);
$routes->get('scenario/afficher_liste_scenario', [Scenario::class, 'afficher_scenarii']);
$routes->get('scenario/afficher_detail_scenario/(:num)', [Scenario::class, 'visualiser']);
$routes->get('scenario/afficher_detail_scenario', [Scenario::class, 'visualiser']);
$routes->get('scenario/ajouter_scenario', [Scenario::class, 'ajouter']);
 $routes->post('scenario/ajouter_scenario', [Scenario::class, 'ajouter']);





use App\Controllers\Etape;
$routes->get('etape/etape_jouer', [Etape::class, 'etape_jouer']);
$routes->get('etape/etape_jouer/(:segment)', [Etape::class, 'etape_jouer']);
$routes->get('etape/etape_jouer/(:num)', [Etape::class, 'etape_jouer']);
$routes->get('etape/etape_jouer/(:segment)/(:num)', [Etape::class, 'etape_jouer']);


?>