<?php

namespace FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class CompanyBusinessUnitsCartsRestApiConfig extends AbstractBundleConfig
{
    public const PARENT_RESOURCE_COMPANY_BUSINESS_UNITS = 'company-business-units';
    public const RESOURCE_COMPANY_BUSINESS_UNIT_CARTS = 'company-business-unit-carts';
    public const RESOURCE_CART_ITEMS = 'items';
    public const RESOURCE_CARTS = 'carts';
    public const CONTROLLER_COMPANY_BUSINESS_UNITS_CARTS = 'company-business-units-carts-resource';

    public const RESPONSE_CODE_COMPANY_BUSINESS_UNIT_IDENTIFIER_MISSING = '3000';
    public const RESPONSE_CODE_CANT_FIND_CART = '3001';
    public const EXCEPTION_MESSAGE_CANT_FIND_CART = 'Can\'t find cart by the given identifier';
    public const EXCEPTION_MESSAGE_COMPANY_BUSINESS_UNIT_IDENTIFIER_MISSING = 'Company business unit uuid is missing.';
}
