<?php

use YOOtheme\Http\Request;
use YOOtheme\Http\Response;

class SourceController
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @throws \Exception
     *
     * @return Response
     */
    public static function contacts(Request $request, Response $response)
    {
        $titles = [];

        $contact = ContactTypeProvider::get($request('ids'));
        $titles[$contact->id] = $contact->name;

        return $response->withJson((object) $titles);
    }
}
