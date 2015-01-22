<?php namespace Burthorpe\Runescape;

use Illuminate\Support\Collection;

class EvolutionOfCombat {

    /*
     * Burthorpe API instance
     *
     * @var \Burthorpe\Runescape\API
     */
    protected $api;

    /*
     * Array of resource URLs
     *
     * @var array
     */
    protected $resources = [
        'hiscores' => 'http://hiscore.runescape.com/index_lite.ws',
    ];

    /*
     * Class constructor
     */
    public function __construct()
    {
        $this->api = new API;
    }

    /*
     * Get a players statistics from the hiscores API feed
     *
     * @return mixed
     */
    public function stats($rsn)
    {
        $response = $this->api->get(
            $this->resources['hiscores'],
            ['query' => [
                    'player' => $rsn,
                ]
            ]
        );

        if ($response->getStatusCode() !== 200)
        {
            return false;
        }

        $raw = array_map(
            function($raw)
            {
                $stat = explode(',', $raw);

                return [
                    'rank' => $stat[0],
                    'level' => $stat[1],
                    'xp' => $stat[2],
                ];
            },
            array_slice(
                explode("\n", $response->getBody()),
                0,
                $this->api->getSkills()->count() - 1
            )
        );

        $collection = new Collection;

        $this->api->getSkills()
                  ->each(function($skill) use ($collection, $raw)
        {
            $collection->put($skill->getName(), new Collection($raw[0]));
        });

        return $collection;
    }

    /*
     * Calculates a players combat level
     *
     * @param integer $attack
     * @param integer $strength
     * @param integer $defence
     * @param integer $ranged
     * @param integer $magic
     * @return integer
     */
    public function calculateCombatLevel($attack, $strength, $defence, $ranged, $magic)
    {
        $highest = max([$attack, $strength, $ranged, $magic]);

        return floor(($highest + $defence) + 2);
    }

}