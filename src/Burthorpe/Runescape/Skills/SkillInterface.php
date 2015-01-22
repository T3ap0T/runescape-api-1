<?php namespace Burthorpe\Runescape\Skills;

interface SkillInterface {

    /*
     * Jagex skill ID
     *
     * @return integer
     */
    public function getId();

    /*
     * Skill name
     *
     * @return string
     */
    public function getName();

    /*
     * Old school skill name
     *
     * @return string
     */
    public function getOldSchoolName();

    /*
     * Maximum possible experience
     *
     * @return integer
     */
    public function getMaximumXp();

    /*
     * Maximum possible level
     *
     * @return integer
     */
    public function getMaximumLevel();

    /*
     * Skill affects your combat level
     *
     * @return bool
     */
    public function isCombatSkill();

    /*
     * Skill is only available to members
     *
     * @return bool
     */
    public function isMembersOnly();

    /*
     * Skill is available in old school
     *
     * @return bool
     */
    public function isOldSchool();

}