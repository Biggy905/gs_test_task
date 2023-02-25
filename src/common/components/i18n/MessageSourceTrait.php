<?php

namespace common\components\i18n;

use yii\i18n\MissingTranslationEvent;

trait MessageSourceTrait
{
    protected function translateMessage($category, $message, $language)
    {
        $key = $language . '/' . $category;
        if (!isset($this->_messages[$key])) {
            $this->_messages[$key] = $this->loadMessages($category, $language);
        }

        if (!empty($this->fallbackLanguage) && !isset($this->_fallback_messages[$key])) {
            $this->_fallback_messages[$key] = $this->loadMessages($category, $this->fallbackLanguage);
        }

        $parts = explode('.', $message);

        if (isset($this->_messages[$key][$message]) && $this->_messages[$key][$message] !== '') {
            return $this->_messages[$key][$message];
        } elseif ($this->hasEventHandlers(self::EVENT_MISSING_TRANSLATION)) {
            $event = new MissingTranslationEvent([
                'category' => $category,
                'message' => $message,
                'language' => $language,
            ]);
            $this->trigger(self::EVENT_MISSING_TRANSLATION, $event);
            if ($event->translatedMessage !== null) {
                return $this->_messages[$key][$message] = $event->translatedMessage;
            }
        } elseif (count($parts) > 1) {
            // Try to find message on required language
            $translatedMessage = $this->_messages[$key];
            $counter = 0;
            foreach ($parts as $part) {
                if (isset($translatedMessage[$part])) {
                    $translatedMessage = $translatedMessage[$part];
                    $counter++;
                }
            }
            if ($counter === count($parts)) {
                return $translatedMessage;
            } else {
                // Try to find message on fallback language
                $translatedMessage = $this->_fallback_messages[$key];
                $counter = 0;
                foreach ($parts as $part) {
                    if (isset($translatedMessage[$part])) {
                        $translatedMessage = $translatedMessage[$part];
                        $counter++;
                    }
                }

                if ($counter === count($parts)) {
                    return $translatedMessage;
                } else {
                    // Return default key
                    return implode('.', [$category, $message]);
                }
            }
        }
        return $this->_messages[$key][$message] = implode('.', [$category, $message]);
    }
}
