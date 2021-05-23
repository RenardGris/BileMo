<?php

use OpenApi\Annotations as OA;

/**
 *
 * General information
 *
 * @OA\Info(
 *     title="Documentation BileMo",
 *     description="Documentation for BileMo project",
 *     version="1.0"
 * )
 *
 *
 *
 * List of parameters
 *
 * @OA\Parameter(
 *     name="id",
 *     in="path",
 *     description="the resource id",
 *     required=true,
 *     @OA\Schema(type="integer")
 * ),

 * @OA\Parameter(
 *     name="page",
 *     in="query",
 *     description="the requested page of paginated collection",
 *     required=false,
 *     @OA\Schema(type="integer")
 * ),
 *
 *
 *
 * List of the possible response
 *
 * @OA\Response(
 *     response="productCollection",
 *     description="return a paginated collection of products",
 *     @OA\JsonContent(
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/productGlobal"),
 *     ),
 * ),
 *
 *
 * @OA\Response(
 *     response="productResource",
 *     description="return the product",
 *     @OA\JsonContent(
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/Product"),
 *     ),
 * ),
 *
 *  * @OA\Response(
 *     response="customerCollection",
 *     description="return a paginated collection of customers",
 *     @OA\JsonContent(
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/customerGlobal"),
 *     ),
 * ),
 *
 *
 * @OA\Response(
 *     response="customerResource",
 *     description="return the customer",
 *     @OA\JsonContent(
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/Customer"),
 *     ),
 * ),
 *
 * @OA\Response(
 *     response="loggedUser",
 *     description="return details from logged user",
 *     @OA\JsonContent(
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/User"),
 *     ),
 * ),
 *
 * @OA\Response(
 *     response="notFound",
 *     description="not found the requested resource",
 *     @OA\JsonContent(
 *          @OA\Property(property="code", type="integer", example="404"),
 *          @OA\Property(property="message", type="string", example="resource not found")
 *     ),
 * ),
 *
 *
 * @OA\Response(
 *     response="delete",
 *     description="delete the requested resource",
 *     @OA\JsonContent(type="object"),
 * ),
 *
 * @OA\Response(
 *     response="invalidToken",
 *     description="return an error message according to an invalid, missing or expired token",
 *     @OA\JsonContent(
 *          @OA\Property(property="code", type="integer", example="401"),
 *          @OA\Property(property="message", type="string", example="invalid token")
 *     ),
 * ),
 *
 * @OA\Response(
 *     response="invalidCredential",
 *     description="return an invalid credential error message",
 *     @OA\JsonContent(
 *          @OA\Property(property="code", type="integer", example="401"),
 *          @OA\Property(property="message", type="string", example="invalid credentials")
 *     ),
 * ),
 *
 * @OA\Response(
 *     response="loggedUser",
 *     description="return a new valid token",
 *     @OA\JsonContent(
 *          @OA\Property(property="token", type="string", example="MyValidToken")
 *     ),
 * ),
 *
 * @OA\Response(
 *     response="badRequest",
 *     description="return a message with the invalid data",
 *     @OA\JsonContent(
 *          @OA\Property(property="code", type="integer", example="400"),
 *          @OA\Property(property="message", type="string", example="This Json content invalid data.")
 *     ),
 * ),
 *
 *
 *
 * List of global schema return in collection
 *
 * @OA\Schema(
 *     schema="productGlobal",
 *     description="Product's global properties",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="brand", type="string"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="model", type="string"),
 * ),
 *
 * @OA\Schema(
 *     schema="customerGlobal",
 *     description="Customer's global properties",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="firstname", type="string"),
 *     @OA\Property(property="lastname", type="string"),
 * ),
 *
 * @OA\Schema(
 *     schema="userGlobal",
 *     description="User's global properties",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="firstname", type="string"),
 *     @OA\Property(property="lastname", type="string"),
 * ),
 *
 *  * @OA\Schema(
 *     schema="User",
 *     description="Customer's properties",
 *     allOf={@OA\Schema(ref="#/components/schemas/userGlobal")},
 *     @OA\Property(property="email", type="string"),
 *     @OA\Property(type="array", @OA\Items(ref="#/components/schemas/customerGlobal")),
 * ),
 *
 * @OA\SecurityScheme(bearerFormat="JWT", type="http", securityScheme="BearerAuth", scheme="bearer"),
 *
 *
 * List of Request Body
 *
 * @OA\RequestBody(
 *     request="storeCustomer",
 *     required=true,
 *     @OA\JsonContent(
 *          @OA\Property(property="firstname", type="string"),
 *          @OA\Property(property="lastname", type="string"),
 *          @OA\Property(property="email", type="string"),
 *     ),
 * ),
 *
 * @OA\RequestBody(
 *     request="loginUser",
 *     required=true,
 *     @OA\JsonContent(
 *          @OA\Property(property="username", type="string", example="username@email.com"),
 *          @OA\Property(property="password", type="string", example="MySecretPassword"),
 *     ),
 * ),
 *
 */
