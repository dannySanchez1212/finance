<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YodleeTransaction extends Model
{
    protected $fillable = [
        "id",
		"container",
		"amount",
		"baseType",
		"categoryType",
		"categoryId",
		"category",
		"categorySource",
		"createdDate",
		"lastUpdated",
		"description",
		"type",
		"subType",
		"isManual",
		"date",
		"transactionDate",
		"postDate",
		"status",
		"accountId",
		"runningBalance",
		"highLevelCategoryId",
		"tenancy_id",
    ];
}