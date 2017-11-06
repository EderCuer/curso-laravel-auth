<?php

function layout()
{
	return \Request::is('admin/*') ? 'layouts.admin':'layouts.app';
}