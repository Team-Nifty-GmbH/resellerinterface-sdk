<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Enums\Status;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailCreate;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailCreateSpamFilterRule;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailDeactivateSpamFilter;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailDelete;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailDeleteByDomain;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailDeleteSpamFilterRule;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailDetails;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailDetailsSpamFilterRule;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailGetDomainsForEmailAddressUpdate;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailGetWebspacesForEmailAddress;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailList;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailListSpamFilterRules;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailMarkSpam;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailRemoveLock;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailSetAutoresponder;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailUpdate;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailUpdateRedirectTargetByDomain;
use TeamNiftyGmbH\ResellerInterface\Requests\Emails\MailUpdateSpamFilterRule;

class Emails extends BaseResource
{
    /**
     * @param  null|string  $eMailAddress  E-Mail-Adresse (optional)
     * @param  null|string  $local  Lokaler Teil (optional)
     * @param  string  $domain  Domainname (sld.tld)
     * @param  Type  $type  E-Mail-Typ
     * @param  null|string  $comment  Kommentar (optional)
     * @param  null|string  $webspace  Webspace (optional)
     * @param  null|int  $inboxId  E-Mail-Postfach ID (optional)
     * @param  null|array  $redirectEmailAddresses  E-Mail-Adressen, zu denen weitergeleitet werden soll (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailCreate(
        ?string $eMailAddress,
        ?string $local,
        string $domain,
        Type $type,
        ?string $comment = null,
        ?string $webspace = null,
        ?int $inboxId = null,
        ?array $redirectEmailAddresses = null,
    ): Response {
        return $this->connector->send(new MailCreate($eMailAddress, $local, $domain, $type, $comment, $webspace, $inboxId, $redirectEmailAddresses));
    }

    /**
     * @param  null|int  $eMailAddressId  ID der E-Mail-Adresse (optional)
     * @param  null|string  $domain  Domainname (sld.tld) (optional)
     * @param  Type  $type  Typ der Filterregel
     * @param  string  $senderAddress  Absender-E-Mail-Adresse
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailCreateSpamFilterRule(
        ?int $eMailAddressId,
        ?string $domain,
        Type $type,
        string $senderAddress,
    ): Response {
        return $this->connector->send(new MailCreateSpamFilterRule($eMailAddressId, $domain, $type, $senderAddress));
    }

    /**
     * @param  null|int  $eMailAddressId  ID der E-Mail-Adresse (optional)
     * @param  null|string  $domain  Domainname (sld.tld) (optional)
     * @param  null|bool  $deactivate  (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailDeactivateSpamFilter(
        ?int $eMailAddressId = null,
        ?string $domain = null,
        ?bool $deactivate = null,
    ): Response {
        return $this->connector->send(new MailDeactivateSpamFilter($eMailAddressId, $domain, $deactivate));
    }

    /**
     * @param  int  $eMailAddressId  ID der E-Mail-Adresse
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailDelete(int $eMailAddressId): Response
    {
        return $this->connector->send(new MailDelete($eMailAddressId));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  null|string  $local  Lokaler Teil (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailDeleteByDomain(string $domain, ?string $local = null): Response
    {
        return $this->connector->send(new MailDeleteByDomain($domain, $local));
    }

    /**
     * @param  int  $spamFilterRuleId  Filterregel-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailDeleteSpamFilterRule(int $spamFilterRuleId): Response
    {
        return $this->connector->send(new MailDeleteSpamFilterRule($spamFilterRuleId));
    }

    /**
     * @param  int  $eMailAddressId  ID der E-Mail-Adresse
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailDetails(int $eMailAddressId): Response
    {
        return $this->connector->send(new MailDetails($eMailAddressId));
    }

    /**
     * @param  int  $spamFilterRuleId  Filterregel-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailDetailsSpamFilterRule(int $spamFilterRuleId): Response
    {
        return $this->connector->send(new MailDetailsSpamFilterRule($spamFilterRuleId));
    }

    /**
     * @param  int  $eMailAddressId  ID der E-Mail-Adresse
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailGetDomainsForEmailAddressUpdate(int $eMailAddressId): Response
    {
        return $this->connector->send(new MailGetDomainsForEmailAddressUpdate($eMailAddressId));
    }

    /**
     * @param  string  $eMailAddress  E-Mail-Adresse
     * @param  string  $domain  Domainname (sld.tld)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailGetWebspacesForEmailAddress(string $eMailAddress, string $domain): Response
    {
        return $this->connector->send(new MailGetWebspacesForEmailAddress($eMailAddress, $domain));
    }

    /**
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailList(
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new MailList($search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  null|int  $eMailAddressId  ID der E-Mail-Adresse (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailListSpamFilterRules(
        ?int $eMailAddressId = null,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new MailListSpamFilterRules($eMailAddressId, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailMarkSpam(string $file): Response
    {
        return $this->connector->send(new MailMarkSpam($file));
    }

    /**
     * @param  int  $eMailAddressId  ID der E-Mail-Adresse
     * @param  string  $document  Freischaltvereinbarung
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailRemoveLock(int $eMailAddressId, string $document): Response
    {
        return $this->connector->send(new MailRemoveLock($eMailAddressId, $document));
    }

    /**
     * @param  int  $eMailAddressId  ID der E-Mail-Adresse
     * @param  null|Status  $status  Status des Autoresponders (optional)
     * @param  null|string  $name  Name (optional)
     * @param  null|string  $subject  Betreff (optional)
     * @param  null|string  $text  Nachricht (optional)
     * @param  null|string  $dateStart  Von Zeitpunkt (optional)
     * @param  string  $dateEnd  Bis Zeitpunkt
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailSetAutoresponder(
        int $eMailAddressId,
        ?Status $status,
        ?string $name,
        ?string $subject,
        ?string $text,
        ?string $dateStart,
        string $dateEnd,
    ): Response {
        return $this->connector->send(new MailSetAutoresponder($eMailAddressId, $status, $name, $subject, $text, $dateStart, $dateEnd));
    }

    /**
     * @param  int  $eMailAddressId  ID der E-Mail-Adresse
     * @param  null|string  $eMailAddress  E-Mail-Adresse (optional)
     * @param  null|string  $local  Lokaler Teil (optional)
     * @param  null|string  $domain  Domainname (sld.tld) (optional)
     * @param  null|Type  $type  E-Mail-Typ (optional)
     * @param  null|string  $webspace  Webspace (optional)
     * @param  null|string  $comment  Kommentar (optional)
     * @param  null|string  $password  Passwort (optional)
     * @param  null|int  $inboxId  E-Mail-Postfach ID (optional)
     * @param  null|array  $redirectEmailAddresses  E-Mail-Adressen, zu denen weitergeleitet werden soll (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailUpdate(
        int $eMailAddressId,
        ?string $eMailAddress = null,
        ?string $local = null,
        ?string $domain = null,
        ?Type $type = null,
        ?string $webspace = null,
        ?string $comment = null,
        ?string $password = null,
        ?int $inboxId = null,
        ?array $redirectEmailAddresses = null,
    ): Response {
        return $this->connector->send(new MailUpdate($eMailAddressId, $eMailAddress, $local, $domain, $type, $webspace, $comment, $password, $inboxId, $redirectEmailAddresses));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  null|string  $local  Lokaler Teil (optional)
     * @param  string  $oldTarget  Altes Ziel
     * @param  string  $newTarget  Neues Ziel
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailUpdateRedirectTargetByDomain(
        string $domain,
        ?string $local,
        string $oldTarget,
        string $newTarget,
    ): Response {
        return $this->connector->send(new MailUpdateRedirectTargetByDomain($domain, $local, $oldTarget, $newTarget));
    }

    /**
     * @param  int  $spamFilterRuleId  Filterregel-ID
     * @param  null|Type  $type  Typ der Filterregel (optional)
     * @param  null|string  $senderAddress  Absender-E-Mail-Adresse (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function mailUpdateSpamFilterRule(
        int $spamFilterRuleId,
        ?Type $type = null,
        ?string $senderAddress = null,
    ): Response {
        return $this->connector->send(new MailUpdateSpamFilterRule($spamFilterRuleId, $type, $senderAddress));
    }
}
