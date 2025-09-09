<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Enums\ResellerID;
use TeamNiftyGmbH\ResellerInterface\Enums\SelectedInterval;
use TeamNiftyGmbH\ResellerInterface\Enums\Software;
use TeamNiftyGmbH\ResellerInterface\Enums\StateFilter;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceActivateFirewallLogging;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceCreate;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceCreateBackup;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceCreateCronjob;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceCreateDatabase;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceCreateDatabaseFirewallEntry;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceCreateDomain;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceCreateFirewallEntry;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceCreateFtpUser;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceCreateProject;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceDelete;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceDeleteBackup;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceDeleteCronjob;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceDeleteDatabase;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceDeleteDatabaseFirewallEntry;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceDeleteDomain;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceDeleteFirewallEntry;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceDeleteFtpUser;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceDeleteProject;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceDetails;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceDetailsBackup;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceGetBackup;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceGetCertificatesForDomain;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceHide;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceInstallSoftware;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceList;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceListBackups;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceListCronjobs;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceListDatabases;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceListDomains;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceListFirewallEntries;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceListFtpUsers;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceListProjects;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceRemoveLock;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceRestore;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceRestoreBackup;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceSetContractRuntime;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceSetDatabasePassword;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceSetPaymentRuntime;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceUndelete;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceUpdate;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceUpdateCronjob;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceUpdateDatabase;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceUpdateDatabaseFirewallEntry;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceUpdateDomain;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceUpdateFirewallEntry;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceUpdateFtpUser;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceUpgrade;
use TeamNiftyGmbH\ResellerInterface\Requests\Webspaces\WebspaceWhitelistFirewallEntry;

class Webspaces extends BaseResource
{
    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  int  $duration  Dauer des Loggings in Minuten
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceActivateFirewallLogging(int $webspace, int $duration): Response
    {
        return $this->connector->send(new WebspaceActivateFirewallLogging($webspace, $duration));
    }

    /**
     * @param  null|int  $runtime  Laufzeit in Monaten (optional)
     * @param  null|int  $paymentRuntime  Zahlungsinterval in Monaten (optional)
     * @param  null|string  $package  Status-Filter (optional)
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceCreate(
        ?int $runtime = null,
        ?int $paymentRuntime = null,
        ?string $package = null,
        ?bool $fullyAsync = null,
    ): Response {
        return $this->connector->send(new WebspaceCreate($runtime, $paymentRuntime, $package, $fullyAsync));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  Type  $type  Webspace-Bereiche für das Backup
     * @param  null|array  $databases  (optional)
     * @param  null|array  $inboxes  (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceCreateBackup(
        int $webspace,
        Type $type,
        ?array $databases = null,
        ?array $inboxes = null,
    ): Response {
        return $this->connector->send(new WebspaceCreateBackup($webspace, $type, $databases, $inboxes));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  string  $name  Cronjob-Name
     * @param  string  $url  Aufzurufende URL
     * @param  SelectedInterval  $selectedInterval  Aktivierungsintervall des Cronjobs
     * @param  null|string  $cronInterval  Benutzerdefiniertes Aktivierungsintervall (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceCreateCronjob(
        int $webspace,
        string $name,
        string $url,
        SelectedInterval $selectedInterval,
        ?string $cronInterval = null,
    ): Response {
        return $this->connector->send(new WebspaceCreateCronjob($webspace, $name, $url, $selectedInterval, $cronInterval));
    }

    /**
     * @param  null|int  $webspace  ID oder Name des Webspaces (optional)
     * @param  null|string  $comment  Kommentar (optional)
     * @param  null|bool  $waitForResponse  Wartet max. 5 Sekunden auf eine Live-Antwort (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceCreateDatabase(
        ?int $webspace = null,
        ?string $comment = null,
        ?bool $waitForResponse = null,
    ): Response {
        return $this->connector->send(new WebspaceCreateDatabase($webspace, $comment, $waitForResponse));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|string  $ip  IP-Adresse (optional)
     * @param  null|string  $comment  Kommentar (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceCreateDatabaseFirewallEntry(
        int $webspace,
        ?string $ip = null,
        ?string $comment = null,
    ): Response {
        return $this->connector->send(new WebspaceCreateDatabaseFirewallEntry($webspace, $ip, $comment));
    }

    /**
     * @param  null|int  $webspace  ID oder Name des Webspaces (optional)
     * @param  null|int  $domain  Domain-ID oder Domainname (optional)
     * @param  null|int  $webspaceProjectId  Webspace-Projekt-ID (optional)
     * @param  string  $subdomain  Subdomain
     * @param  string  $directory  Verzeichnis
     * @param  null|int  $tlsCertificateId  SSL-Zertifikats-ID (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceCreateDomain(
        ?int $webspace,
        ?int $domain,
        ?int $webspaceProjectId,
        string $subdomain,
        string $directory,
        ?int $tlsCertificateId = null,
    ): Response {
        return $this->connector->send(new WebspaceCreateDomain($webspace, $domain, $webspaceProjectId, $subdomain, $directory, $tlsCertificateId));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|string  $ip  IP-Adresse (optional)
     * @param  string  $port  Der oder die Freizugebene(n) Ports, z.B. "80", "80, 443", "10000-10200"
     * @param  string  $comment  Kommentar
     * @param  bool  $acceptRules  Firewall-Regeln akzeptiert
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceCreateFirewallEntry(
        int $webspace,
        ?string $ip,
        string $port,
        string $comment,
        bool $acceptRules,
    ): Response {
        return $this->connector->send(new WebspaceCreateFirewallEntry($webspace, $ip, $port, $comment, $acceptRules));
    }

    /**
     * @param  null|int  $webspace  ID oder Name des Webspaces (optional)
     * @param  null|int  $webspaceProjectId  Webspace-Projekt-ID (optional)
     * @param  null|string  $directory  Verzeichnis (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceCreateFtpUser(
        ?int $webspace = null,
        ?int $webspaceProjectId = null,
        ?string $directory = null,
    ): Response {
        return $this->connector->send(new WebspaceCreateFtpUser($webspace, $webspaceProjectId, $directory));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  string  $directory  Verzeichnis
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceCreateProject(int $webspace, string $directory): Response
    {
        return $this->connector->send(new WebspaceCreateProject($webspace, $directory));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|string  $date  Datum (optional)
     * @param  null|string  $reason  Grund der Kündigung (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceDelete(int $webspace, ?string $date = null, ?string $reason = null): Response
    {
        return $this->connector->send(new WebspaceDelete($webspace, $date, $reason));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceDeleteBackup(int $webspace, int $webspaceBackupId): Response
    {
        return $this->connector->send(new WebspaceDeleteBackup($webspace, $webspaceBackupId));
    }

    /**
     * @param  int  $webspaceCronjobId  ID des Cronjobs
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceDeleteCronjob(int $webspaceCronjobId): Response
    {
        return $this->connector->send(new WebspaceDeleteCronjob($webspaceCronjobId));
    }

    /**
     * @param  int  $webspaceDatabaseId  ID der Datenbank
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceDeleteDatabase(int $webspaceDatabaseId): Response
    {
        return $this->connector->send(new WebspaceDeleteDatabase($webspaceDatabaseId));
    }

    /**
     * @param  int  $webspaceDatabaseFirewallEntryId  ID des Datenbank-Firewall-Eintrags
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|string  $ip  IP-Adresse (optional)
     * @param  null|string  $comment  Kommentar (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceDeleteDatabaseFirewallEntry(
        int $webspaceDatabaseFirewallEntryId,
        int $webspace,
        ?string $ip = null,
        ?string $comment = null,
    ): Response {
        return $this->connector->send(new WebspaceDeleteDatabaseFirewallEntry($webspaceDatabaseFirewallEntryId, $webspace, $ip, $comment));
    }

    /**
     * @param  int  $webspaceDomainId  ID der Webspace-Domain
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceDeleteDomain(int $webspaceDomainId): Response
    {
        return $this->connector->send(new WebspaceDeleteDomain($webspaceDomainId));
    }

    /**
     * @param  null|int  $webspaceFirewallEntryId  ID des Firewall-Eintrags (optional)
     * @param  null|int  $webspace  ID oder Name des Webspaces (optional)
     * @param  null|string  $ip  IP-Adresse (optional)
     * @param  null|string  $port  Der oder die Freizugebene(n) Ports, z.B. "80", "80, 443", "10000-10200" (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceDeleteFirewallEntry(
        ?int $webspaceFirewallEntryId = null,
        ?int $webspace = null,
        ?string $ip = null,
        ?string $port = null,
    ): Response {
        return $this->connector->send(new WebspaceDeleteFirewallEntry($webspaceFirewallEntryId, $webspace, $ip, $port));
    }

    /**
     * @param  int  $webspaceFtpUserId  ID des FTP-Benutzers
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceDeleteFtpUser(int $webspaceFtpUserId): Response
    {
        return $this->connector->send(new WebspaceDeleteFtpUser($webspaceFtpUserId));
    }

    /**
     * @param  null|int  $webspaceProjectId  Webspace-Projekt-ID (optional)
     * @param  null|int  $webspace  ID oder Name des Webspaces (optional)
     * @param  null|string  $directory  Verzeichnis (optional)
     * @param  null|bool  $force  Erzwingen (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceDeleteProject(
        ?int $webspaceProjectId = null,
        ?int $webspace = null,
        ?string $directory = null,
        ?bool $force = null,
    ): Response {
        return $this->connector->send(new WebspaceDeleteProject($webspaceProjectId, $webspace, $directory, $force));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceDetails(int $webspace): Response
    {
        return $this->connector->send(new WebspaceDetails($webspace));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceDetailsBackup(int $webspace, int $webspaceBackupId): Response
    {
        return $this->connector->send(new WebspaceDetailsBackup($webspace, $webspaceBackupId));
    }

    /**
     * @param  null|int  $webspace  ID oder Name des Webspaces (optional)
     * @param  null|bool  $force  Erzwingen (optional)
     * @param  null|bool  $waitForResponse  Wartet max. 5 Sekunden auf eine Live-Antwort (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceGetBackup(
        ?int $webspace = null,
        ?bool $force = null,
        ?bool $waitForResponse = null,
    ): Response {
        return $this->connector->send(new WebspaceGetBackup($webspace, $force, $waitForResponse));
    }

    /**
     * @param  null|int  $webspaceDomainId  ID der Webspace-Domain (optional)
     * @param  null|int  $domain  Domain-ID oder Domainname (optional)
     * @param  string  $subdomain  Subdomain
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceGetCertificatesForDomain(
        ?int $webspaceDomainId,
        ?int $domain,
        string $subdomain,
    ): Response {
        return $this->connector->send(new WebspaceGetCertificatesForDomain($webspaceDomainId, $domain, $subdomain));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceHide(int $webspace): Response
    {
        return $this->connector->send(new WebspaceHide($webspace));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  int  $webspaceDomainId  ID der Webspace-Domain
     * @param  null|int  $webspaceDatabaseId  ID der Datenbank (optional)
     * @param  Software  $software  Gewünschte Software
     * @param  null|string  $title  Webseitentitel (optional)
     * @param  null|string  $username  Nutzername für neuen Nutzer (optional)
     * @param  null|string  $password  Passwort für neuen Nutzer (optional)
     * @param  string  $email  E-Mail-Adresse für neuen Nutzer
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceInstallSoftware(
        int $webspace,
        int $webspaceDomainId,
        ?int $webspaceDatabaseId,
        Software $software,
        ?string $title,
        ?string $username,
        ?string $password,
        string $email,
    ): Response {
        return $this->connector->send(new WebspaceInstallSoftware($webspace, $webspaceDomainId, $webspaceDatabaseId, $software, $title, $username, $password, $email));
    }

    /**
     * @param  null|ResellerID  $resellerId  Reseller-ID (optional)
     * @param  null|StateFilter  $stateFilter  Status-Filter (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|array  $include  Weitere Informationen abfragen (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceList(
        ?ResellerID $resellerId = null,
        ?StateFilter $stateFilter = null,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?array $include = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new WebspaceList($resellerId, $stateFilter, $search, $filter, $sort, $include, $offset, $limit));
    }

    /**
     * @param  null|int  $webspace  ID oder Name des Webspaces (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceListBackups(?int $webspace = null): Response
    {
        return $this->connector->send(new WebspaceListBackups($webspace));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceListCronjobs(
        int $webspace,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new WebspaceListCronjobs($webspace, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceListDatabases(
        int $webspace,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new WebspaceListDatabases($webspace, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceListDomains(
        int $webspace,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new WebspaceListDomains($webspace, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceListFirewallEntries(
        int $webspace,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new WebspaceListFirewallEntries($webspace, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceListFtpUsers(
        int $webspace,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new WebspaceListFtpUsers($webspace, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceListProjects(
        int $webspace,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new WebspaceListProjects($webspace, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  string  $document  Freischaltvereinbarung
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceRemoveLock(int $webspace, string $document): Response
    {
        return $this->connector->send(new WebspaceRemoveLock($webspace, $document));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|int  $runtime  Laufzeit in Monaten (optional)
     * @param  bool  $revocationAccepted  Widerrufsrecht akzeptiert
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceRestore(
        int $webspace,
        ?int $runtime,
        bool $revocationAccepted,
        ?bool $fullyAsync = null,
    ): Response {
        return $this->connector->send(new WebspaceRestore($webspace, $runtime, $revocationAccepted, $fullyAsync));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  Type  $type  Webspace-Bereiche für das Backup
     * @param  null|array  $databases  (optional)
     * @param  null|array  $inboxes  (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceRestoreBackup(
        int $webspace,
        int $webspaceBackupId,
        Type $type,
        ?array $databases = null,
        ?array $inboxes = null,
    ): Response {
        return $this->connector->send(new WebspaceRestoreBackup($webspace, $webspaceBackupId, $type, $databases, $inboxes));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  int  $contractRuntime  Vertragslaufzeit in Monaten
     * @param  null|int  $paymentRuntime  Zahlungsinterval in Monaten (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceSetContractRuntime(
        int $webspace,
        int $contractRuntime,
        ?int $paymentRuntime = null,
    ): Response {
        return $this->connector->send(new WebspaceSetContractRuntime($webspace, $contractRuntime, $paymentRuntime));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  string  $password  Passwort
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceSetDatabasePassword(int $webspace, string $password): Response
    {
        return $this->connector->send(new WebspaceSetDatabasePassword($webspace, $password));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  int  $paymentRuntime  Zahlungsinterval in Monaten
     * @param  null|bool  $forNextContractPeriod  Zahlungsintervall erst bei der nächsten Vertragsverlängerung anpassen anstatt zum nächstmöglichen Zeitpunkt (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceSetPaymentRuntime(
        int $webspace,
        int $paymentRuntime,
        ?bool $forNextContractPeriod = null,
    ): Response {
        return $this->connector->send(new WebspaceSetPaymentRuntime($webspace, $paymentRuntime, $forNextContractPeriod));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceUndelete(int $webspace): Response
    {
        return $this->connector->send(new WebspaceUndelete($webspace));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  string  $tag  Tag
     * @param  string  $comment  Kommentar
     * @param  null|array  $contactAddress  Ansprechpartner (optional)
     * @param  null|array  $settings  Einstellungen (optional) [[setting/listWebspaceSettings](#post-/setting/listWebspaceSettings)]
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceUpdate(
        int $webspace,
        string $tag,
        string $comment,
        ?array $contactAddress = null,
        ?array $settings = null,
    ): Response {
        return $this->connector->send(new WebspaceUpdate($webspace, $tag, $comment, $contactAddress, $settings));
    }

    /**
     * @param  int  $webspaceCronjobId  ID des Cronjobs
     * @param  null|bool  $active  Ist der Cronjob aktiv (optional)
     * @param  null|string  $name  Cronjob-Name (optional)
     * @param  null|string  $url  Aufzurufende URL (optional)
     * @param  null|SelectedInterval  $selectedInterval  Aktivierungsintervall des Cronjobs (optional)
     * @param  null|string  $cronInterval  Benutzerdefiniertes Aktivierungsintervall (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceUpdateCronjob(
        int $webspaceCronjobId,
        ?bool $active = null,
        ?string $name = null,
        ?string $url = null,
        ?SelectedInterval $selectedInterval = null,
        ?string $cronInterval = null,
    ): Response {
        return $this->connector->send(new WebspaceUpdateCronjob($webspaceCronjobId, $active, $name, $url, $selectedInterval, $cronInterval));
    }

    /**
     * @param  int  $webspaceDatabaseId  ID der Datenbank
     * @param  null|string  $comment  Kommentar (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceUpdateDatabase(int $webspaceDatabaseId, ?string $comment = null): Response
    {
        return $this->connector->send(new WebspaceUpdateDatabase($webspaceDatabaseId, $comment));
    }

    /**
     * @param  int  $webspaceDatabaseFirewallEntryId  ID des Datenbank-Firewall-Eintrags
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|string  $ip  IP-Adresse (optional)
     * @param  null|string  $comment  Kommentar (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceUpdateDatabaseFirewallEntry(
        int $webspaceDatabaseFirewallEntryId,
        int $webspace,
        ?string $ip = null,
        ?string $comment = null,
    ): Response {
        return $this->connector->send(new WebspaceUpdateDatabaseFirewallEntry($webspaceDatabaseFirewallEntryId, $webspace, $ip, $comment));
    }

    /**
     * @param  int  $webspaceDomainId  ID der Webspace-Domain
     * @param  null|int  $webspaceProjectId  Webspace-Projekt-ID (optional)
     * @param  string  $directory  Verzeichnis
     * @param  null|int  $tlsCertificateId  SSL-Zertifikats-ID (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceUpdateDomain(
        int $webspaceDomainId,
        ?int $webspaceProjectId,
        string $directory,
        ?int $tlsCertificateId = null,
    ): Response {
        return $this->connector->send(new WebspaceUpdateDomain($webspaceDomainId, $webspaceProjectId, $directory, $tlsCertificateId));
    }

    /**
     * @param  null|int  $webspaceFirewallEntryId  ID des Firewall-Eintrags (optional)
     * @param  null|int  $webspace  ID oder Name des Webspaces (optional)
     * @param  null|string  $ip  IP-Adresse (optional)
     * @param  null|string  $port  Der oder die Freizugebene(n) Ports, z.B. "80", "80, 443", "10000-10200" (optional)
     * @param  string  $comment  Kommentar
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceUpdateFirewallEntry(
        ?int $webspaceFirewallEntryId,
        ?int $webspace,
        ?string $ip,
        ?string $port,
        string $comment,
    ): Response {
        return $this->connector->send(new WebspaceUpdateFirewallEntry($webspaceFirewallEntryId, $webspace, $ip, $port, $comment));
    }

    /**
     * @param  int  $webspaceFtpUserId  ID des FTP-Benutzers
     * @param  null|int  $comment  Kommentar (optional)
     * @param  null|string  $password  Passwort (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceUpdateFtpUser(
        int $webspaceFtpUserId,
        ?int $comment = null,
        ?string $password = null,
    ): Response {
        return $this->connector->send(new WebspaceUpdateFtpUser($webspaceFtpUserId, $comment, $password));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|int  $runtime  Laufzeit in Monaten (optional)
     * @param  null|int  $paymentRuntime  Zahlungsinterval in Monaten (optional)
     * @param  null|string  $package  Status-Filter (optional)
     * @param  bool  $revocationAccepted  Widerrufsrecht akzeptiert
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceUpgrade(
        int $webspace,
        ?int $runtime,
        ?int $paymentRuntime,
        ?string $package,
        bool $revocationAccepted,
        ?bool $fullyAsync = null,
    ): Response {
        return $this->connector->send(new WebspaceUpgrade($webspace, $runtime, $paymentRuntime, $package, $revocationAccepted, $fullyAsync));
    }

    /**
     * @param  null|int  $webspaceFirewallEntryId  ID des Firewall-Eintrags (optional)
     * @param  null|int  $webspace  ID oder Name des Webspaces (optional)
     * @param  null|string  $ip  IP-Adresse (optional)
     * @param  null|string  $port  Der oder die Freizugebene(n) Ports, z.B. "80", "80, 443", "10000-10200" (optional)
     * @param  string  $comment  Kommentar
     * @param  bool  $acceptRules  Firewall-Regeln akzeptiert
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webspaceWhitelistFirewallEntry(
        ?int $webspaceFirewallEntryId,
        ?int $webspace,
        ?string $ip,
        ?string $port,
        string $comment,
        bool $acceptRules,
    ): Response {
        return $this->connector->send(new WebspaceWhitelistFirewallEntry($webspaceFirewallEntryId, $webspace, $ip, $port, $comment, $acceptRules));
    }
}
