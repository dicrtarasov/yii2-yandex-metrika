<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 31.03.21 19:28:54
 */

declare(strict_types = 1);
namespace dicr\yandex\metrika\manage\entity;

use dicr\json\EntityValidator;
use dicr\yandex\metrika\Entity;

use function array_merge;

/**
 * Настройки кода счетчика.
 */
class CodeOptions extends Entity
{
    /** @var bool Асинхронный код счетчика. */
    public $async;

    /** @var Informer Настройки информера */
    public $informer;

    /** @var bool Запись и анализ поведения посетителей сайта. */
    public $visor;

    /** @var bool Отслеживание хеша в адресной строке браузера. Опция применима для AJAX-сайтов. */
    public $trackHash;

    /** @var bool Для XML-сайтов. Элемент noscript не должен использоваться в XML документах. */
    public $xmlSite;

    /** @var bool Сбор статистики для работы отчета Карта кликов. */
    public $clickmap;

    /** @var bool Выводить код счетчика в одну строку. */
    public $inOneLine;

    /** @var bool Сбор данных по электронной коммерции. */
    public $ecommerce;

    /**
     * @var bool Позволяет корректно учитывать посещения из регионов, в которых ограничен доступ к ресурсам Яндекса.
     * Использование этой опции может снизить скорость загрузки кода счётчика.
     */
    public $alternativeCdn;

    /* Недокументированные из JSON-ответа */

    /** @var string название javascript-переменной для данных. По-умолчанию "dataLayer" */
    public $ecommerceObject;

    /**
     * @inheritDoc
     */
    public function attributeEntities() : array
    {
        return array_merge(parent::attributeEntities(), [
            'informer' => Informer::class
        ]);
    }

    /**
     * @inheritDoc
     */
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            ['async', 'default'],
            ['async', 'boolean'],
            ['async', 'filter', 'filter' => 'intval', 'skipOnEmpty' => true],

            ['informer', 'default'],
            ['informer', EntityValidator::class, 'class' => Informer::class],

            [['visor', 'trackHash', 'xmlSite', 'clickmap', 'inOneLine', 'ecommerce', 'alternativeCdn'], 'default'],
            [['visor', 'trackHash', 'xmlSite', 'clickmap', 'inOneLine', 'ecommerce', 'alternativeCdn'], 'boolean'],
            [['visor', 'trackHash', 'xmlSite', 'clickmap', 'inOneLine', 'ecommerce', 'alternativeCdn'], 'filter',
                'filter' => 'intval', 'skipOnEmpty' => true],

            ['ecommerceObject', 'default'],
            ['ecommerceObject', 'string']
        ]);
    }
}
