<?php

/**
 * Unique Tag plugin for Craft CMS.
 *
 * Prevent duplicate tags from being saved in the same group.
 *
 * @author    Joshua Baker
 * @copyright Copyright (c) 2016 Joshua Baker
 *
 * @link      https://joshuabaker.com/
 * @since     0.1.0
 */
namespace Craft;

class UniqueTagPlugin extends BasePlugin
{
    /**
     * @return mixed
     */
    public function init()
    {
        craft()->on('tags.onBeforeSaveTag', function (Event $event) {
            $tag = $event->params['tag'];
            $isNewTag = $event->params['isNewTag'];

            if ($isNewTag) {
                $criteria = craft()->elements->getCriteria(ElementType::Tag);
                $criteria->title = $tag->title;

                $event->performAction = $criteria->count() == 0;
            }
        });
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return Craft::t('Unique Tag');
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return Craft::t('Prevent duplicate tags from being saved in the same group.');
    }

    /**
     * @return string
     */
    public function getDocumentationUrl()
    {
        return 'https://github.com/joshuabaker/craft-unique-tag/blob/master/README.md';
    }

    /**
     * @return string
     */
    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/joshuabaker/craft-unique-tag/master/releases.json';
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return '0.1.0';
    }

    /**
     * @return string
     */
    public function getSchemaVersion()
    {
        return '0.1.0';
    }

    /**
     * @return string
     */
    public function getDeveloper()
    {
        return 'Joshua Baker';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'https://joshuabaker.com/';
    }
}
