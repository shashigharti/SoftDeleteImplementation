<?php
namespace Filters;
use Doctrine\ORM\Mapping\ClassMetaData,
    Doctrine\ORM\Query\Filter\SQLFilter;

class SoftDeleteable extends SQLFilter
{
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        
        return $targetTableAlias.'.deleted_at = ' . $this->getParameter('deleted_at'); // getParameter applies quoting automatically
    }
}