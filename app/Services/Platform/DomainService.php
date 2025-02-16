<?php

namespace App\Services\Platform;

class DomainService
{
    public function getTenantDomains()
    {
        return tenant()->domains;
    }

    public function createDomain(array $data)
    {
        if ($this->checkDomain($data['domain'])) {
            throw new \Exception('Domain already exists');
        }
        $data['status'] = 'inactive';
        return tenant()->domains()->create($data);
    }

    public function checkDomain(string $domain)
    {
        return tenant()->domains()->where('domain', $domain)->exists();
    }

    public function deleteDomain($id)
    {
        $domain = tenant()->domains()->find($id);
        if (!$domain) {
            throw new \Exception('Domain does not exist.');
        }
        return $domain->delete();
    }

}

