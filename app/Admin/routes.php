<?php

 Route::get('', ['as' => 'admin.dashboard', function () {
 	$content = 'Define your dashboard here.';
 	return AdminSection::view($content, 'Dashboard');
 }]);

 Route::get('information', ['as' => 'admin.information', function () {
 	$content = 'Define your information here.';
 	return AdminSection::view($content, 'Information');
 }]);

 Route::get('services', ['as' => 'admin.services', function() {
 	$content = 'Редактирование сервисов';
 	return AdminSection::view($content, 'Services');
}]);