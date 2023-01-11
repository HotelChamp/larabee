<?php

namespace Hotelchamp\Larabee\Resources;

use ChargeBee\ChargeBee\Models\PortalSession;

class PortalSessions
{
    /**
     * Find a portal session by id
     *
     * @param string $id
     * @return PortalSession
     */
    public function findById(string $id): PortalSession
    {
        return PortalSession::retrieve($id)->portalSession();
    }

    /**
     * Create a new portal session
     *
     * @param array $data
     * @return PortalSession
     */
    public function create(array $data): PortalSession
    {
        return PortalSession::create($data)->portalSession();
    }

    /**
     * Activate a portal session
     *
     * @param string $id
     * @param array $params
     * @return mixed|null
     */
    public function activate(string $id, array $params)
    {
        return PortalSession::activate($id, $params)->portalSession();
    }

    /**
     * Logout a portal session
     *
     * @param string $id
     * @return mixed|null
     */
    public function logout(string $id)
    {
        return PortalSession::logout($id)->portalSession();
    }
}
