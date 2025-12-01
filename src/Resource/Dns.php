<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Enums\IpVersion;
use TeamNiftyGmbH\ResellerInterface\Enums\Mode;
use TeamNiftyGmbH\ResellerInterface\Enums\RedirectCode;
use TeamNiftyGmbH\ResellerInterface\Enums\DnsRecordType;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsCreateBackup;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsCreateRecord;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsCreateRrtemplate;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsCreateRrtemplateRecord;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsCreateZone;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsCreateZoneDefault;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsDeleteBackup;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsDeleteRecord;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsDeleteRrtemplate;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsDeleteRrtemplateRecord;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsDeleteZone;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsDetailsRrtemplate;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsDisableDnssec;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsEnableDnssec;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsGetBackup;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsGetPresets;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsGetZoneDetails;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsListBackups;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsListRecords;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsListRrtemplates;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsModifyZoneRecords;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsRestoreBackup;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsSetRecords;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsSetRrtemplate;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsSetVns;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsUpdateRecord;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsUpdateRrtemplate;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsUpdateRrtemplateRecord;
use TeamNiftyGmbH\ResellerInterface\Requests\Dns\DnsUpdateZone;

class Dns extends BaseResource
{
    /**
     * @param  string  $domain  Domainname (sld.tld)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsCreateBackup(string $domain): Response
    {
        return $this->connector->send(new DnsCreateBackup($domain));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  null|string  $name  Resource-Name (optional)
     * @param  DnsRecordType  $type  Resource-Typ
     * @param  null|int  $ttl  Gültigkeit der Resource (optional)
     * @param  null|int  $priority  Resource-Priorität (optional)
     * @param  string  $content  Resource-Data
     * @param  null|string  $uri  Ziel URL der Frame-/Header-Weiterleitung (optional)
     * @param  null|RedirectCode  $redirectCode  HTTP-Statuscode für die Header-Weiterleitung (optional)
     * @param  null|string  $title  Titeltext der Frame-Weiterleitung (optional)
     * @param  null|string  $desc  Beschreibungstext der Frame-Weiterleitung (optional)
     * @param  null|string  $keywords  Schlüsselwörter der Frame-Weiterleitung (optional)
     * @param  null|string  $favicon  URL zum Favoriten-Symbol der Frame-Weiterleitung (optional)
     * @param  null|int  $flexDnsuserId  Benutzer-ID des FlexDNS-Benutzers (optional)
     * @param  null|IpVersion  $flexDnsipVersion  FlexDNS Aktualisierungsbereich (optional)
     * @param  null|string  $flexDnsinterfaceId  FlexDNS IPv6-Interface-ID (optional)
     * @param  null|bool  $overwriteConflicts  Überschreiben von Records, welche in Konflikt mit dem neuem Record stehen (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsCreateRecord(
        string $domain,
        ?string $name,
        DnsRecordType $type,
        ?int $ttl,
        ?int $priority,
        string $content,
        ?string $uri = null,
        ?RedirectCode $redirectCode = null,
        ?string $title = null,
        ?string $desc = null,
        ?string $keywords = null,
        ?string $favicon = null,
        ?int $flexDnsuserId = null,
        ?IpVersion $flexDnsipVersion = null,
        ?string $flexDnsinterfaceId = null,
        ?bool $overwriteConflicts = null,
    ): Response {
        return $this->connector->send(new DnsCreateRecord($domain, $name, $type, $ttl, $priority, $content, $uri, $redirectCode, $title, $desc, $keywords, $favicon, $flexDnsuserId, $flexDnsipVersion, $flexDnsinterfaceId, $overwriteConflicts));
    }

    /**
     * @param  null|string  $name  Name des Resource-Record-Templates (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsCreateRrtemplate(?string $name = null): Response
    {
        return $this->connector->send(new DnsCreateRrtemplate($name));
    }

    /**
     * @param  int  $rrtemplateId  Resource-Record-Template-ID
     * @param  null|string  $name  Resource-Name (optional)
     * @param  null|int  $ttl  Gültigkeit der Resource (optional)
     * @param  DnsRecordType  $type  Resource-Typ
     * @param  null|int  $priority  Resource-Priorität (optional)
     * @param  string  $content  Resource-Data
     * @param  null|string  $uri  Ziel URL der Frame-/Header-Weiterleitung (optional)
     * @param  null|RedirectCode  $redirectCode  HTTP-Statuscode für die Header-Weiterleitung (optional)
     * @param  null|string  $favicon  URL zum Favoriten-Symbol der Frame-Weiterleitung (optional)
     * @param  null|string  $title  Titeltext der Frame-Weiterleitung (optional)
     * @param  null|string  $desc  Beschreibungstext der Frame-Weiterleitung (optional)
     * @param  null|string  $keywords  Schlüsselwörter der Frame-Weiterleitung (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsCreateRrtemplateRecord(
        int $rrtemplateId,
        ?string $name,
        ?int $ttl,
        DnsRecordType $type,
        ?int $priority,
        string $content,
        ?string $uri = null,
        ?RedirectCode $redirectCode = null,
        ?string $favicon = null,
        ?string $title = null,
        ?string $desc = null,
        ?string $keywords = null,
    ): Response {
        return $this->connector->send(new DnsCreateRrtemplateRecord($rrtemplateId, $name, $ttl, $type, $priority, $content, $uri, $redirectCode, $favicon, $title, $desc, $keywords));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  string  $primary  Primärer Nameserver für die Zone
     * @param  string  $mail  E-Mail-Adresse der Verantwortlichen für die Zone
     * @param  null|int  $refresh  Aktualisierung der sekundären Nameserver (optional)
     * @param  null|int  $retry  Erneuter Versuch der Aktualisierung der sekundären Nameserver (optional)
     * @param  null|int  $expire  Ablauf der Zone wenn kein Aktualisierung der sekundären Nameserver erfolgt (optional)
     * @param  null|int  $minimum  Minimum TTL der Resource Records (optional)
     * @param  null|int  $ttl  Gültigkeit der Resource (optional)
     * @param  null|int  $vnsId  ID eines virtuellen Nameservers (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsCreateZone(
        string $domain,
        string $primary,
        string $mail,
        ?int $refresh = null,
        ?int $retry = null,
        ?int $expire = null,
        ?int $minimum = null,
        ?int $ttl = null,
        ?int $vnsId = null,
    ): Response {
        return $this->connector->send(new DnsCreateZone($domain, $primary, $mail, $refresh, $retry, $expire, $minimum, $ttl, $vnsId));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsCreateZoneDefault(string $domain): Response
    {
        return $this->connector->send(new DnsCreateZoneDefault($domain));
    }

    /**
     * @param  int  $backupId  Zonen-Backup-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsDeleteBackup(int $backupId): Response
    {
        return $this->connector->send(new DnsDeleteBackup($backupId));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  int  $id  Record-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsDeleteRecord(string $domain, int $id): Response
    {
        return $this->connector->send(new DnsDeleteRecord($domain, $id));
    }

    /**
     * @param  int  $rrtemplateId  Resource-Record-Template-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsDeleteRrtemplate(int $rrtemplateId): Response
    {
        return $this->connector->send(new DnsDeleteRrtemplate($rrtemplateId));
    }

    /**
     * @param  int  $rrtemplateRecordId  Resource-Record-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsDeleteRrtemplateRecord(int $rrtemplateRecordId): Response
    {
        return $this->connector->send(new DnsDeleteRrtemplateRecord($rrtemplateRecordId));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsDeleteZone(string $domain): Response
    {
        return $this->connector->send(new DnsDeleteZone($domain));
    }

    /**
     * @param  int  $rrtemplateId  Resource-Record-Template-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsDetailsRrtemplate(int $rrtemplateId): Response
    {
        return $this->connector->send(new DnsDetailsRrtemplate($rrtemplateId));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsDisableDnssec(string $domain): Response
    {
        return $this->connector->send(new DnsDisableDnssec($domain));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsEnableDnssec(string $domain): Response
    {
        return $this->connector->send(new DnsEnableDnssec($domain));
    }

    /**
     * @param  int  $backupId  Zonen-Backup-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsGetBackup(int $backupId): Response
    {
        return $this->connector->send(new DnsGetBackup($backupId));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsGetPresets(): Response
    {
        return $this->connector->send(new DnsGetPresets());
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  null|string  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsGetZoneDetails(string $domain, ?string $search = null, ?array $filter = null): Response
    {
        return $this->connector->send(new DnsGetZoneDetails($domain, $search, $filter));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsListBackups(string $domain): Response
    {
        return $this->connector->send(new DnsListBackups($domain));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  null|string  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsListRecords(string $domain, ?string $search = null, ?array $filter = null): Response
    {
        return $this->connector->send(new DnsListRecords($domain, $search, $filter));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsListRrtemplates(): Response
    {
        return $this->connector->send(new DnsListRrtemplates());
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  Mode  $mode  Resource-Records anlegen, ersetzen oder löschen
     * @param  null|string  $name  Resource-Name (optional)
     * @param  null|int  $ttl  Gültigkeit der Resource (optional)
     * @param  null|Type  $type  Resource-Typ (optional)
     * @param  null|int  $priority  Resource-Priorität (optional)
     * @param  null|string  $content  Resource-Data (optional)
     * @param  null|string  $matchContent  Alte Resource-Data (optional)
     * @param  null|string  $soaMail  E-Mail-Adresse der Verantwortlichen für die Zone (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsModifyZoneRecords(
        string $domain,
        Mode $mode,
        ?string $name = null,
        ?int $ttl = null,
        ?DnsRecordType $type = null,
        ?int $priority = null,
        ?string $content = null,
        ?string $matchContent = null,
        ?string $soaMail = null,
    ): Response {
        return $this->connector->send(new DnsModifyZoneRecords($domain, $mode, $name, $ttl, $type, $priority, $content, $matchContent, $soaMail));
    }

    /**
     * @param  int  $backupId  Zonen-Backup-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsRestoreBackup(int $backupId): Response
    {
        return $this->connector->send(new DnsRestoreBackup($backupId));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  null|bool  $clearZone  Zone vor Anwendung löschen (optional)
     * @param  null|bool  $backupZone  Backup der Zone vor Anwendung erstellen (optional)
     * @param  array  $records  [[dns/updateRecord](#post-/dns/updateRecord)]
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsSetRecords(
        string $domain,
        ?bool $clearZone,
        ?bool $backupZone,
        array $records,
    ): Response {
        return $this->connector->send(new DnsSetRecords($domain, $clearZone, $backupZone, $records));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  null|bool  $clearZone  Zone vor Anwendung löschen (optional)
     * @param  null|bool  $backupZone  Backup der Zone vor Anwendung erstellen (optional)
     * @param  int  $rrtemplateId  Resource-Record-Template-ID
     * @param  null|string  $ipv4  Wert für IPv4-Platzhalter (optional)
     * @param  null|string  $ipv6  Wert für IPv6-Platzhalter (optional)
     * @param  null|string  $mxIpv4  Wert für mxIPv4-Platzhalter (optional)
     * @param  null|string  $mxIpv6  Wert für mxIPv6-Platzhalter (optional)
     * @param  null|string  $custom1  (optional)
     * @param  null|string  $custom2  Wert für Custom2-Platzhalter (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsSetRrtemplate(
        string $domain,
        ?bool $clearZone,
        ?bool $backupZone,
        int $rrtemplateId,
        ?string $ipv4 = null,
        ?string $ipv6 = null,
        ?string $mxIpv4 = null,
        ?string $mxIpv6 = null,
        ?string $custom1 = null,
        ?string $custom2 = null,
    ): Response {
        return $this->connector->send(new DnsSetRrtemplate($domain, $clearZone, $backupZone, $rrtemplateId, $ipv4, $ipv6, $mxIpv4, $mxIpv6, $custom1, $custom2));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  int  $vnsId  ID eines virtuellen Nameservers
     * @param  null|bool  $forceDomainUpdate  Führt sofortiges update der Nameserver aus (optional, default: false) (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsSetVns(string $domain, int $vnsId, ?bool $forceDomainUpdate = null): Response
    {
        return $this->connector->send(new DnsSetVns($domain, $vnsId, $forceDomainUpdate));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  int  $id  Record-ID
     * @param  null|string  $name  Resource-Name (optional)
     * @param  null|int  $ttl  Gültigkeit der Resource (optional)
     * @param  DnsRecordType  $type  Resource-Typ
     * @param  null|int  $priority  Resource-Priorität (optional)
     * @param  string  $content  Resource-Data
     * @param  null|string  $uri  Ziel URL der Frame-/Header-Weiterleitung (optional)
     * @param  null|RedirectCode  $redirectCode  HTTP-Statuscode für die Header-Weiterleitung (optional)
     * @param  null|string  $favicon  URL zum Favoriten-Symbol der Frame-Weiterleitung (optional)
     * @param  null|string  $title  Titeltext der Frame-Weiterleitung (optional)
     * @param  null|string  $desc  Beschreibungstext der Frame-Weiterleitung (optional)
     * @param  null|string  $keywords  Schlüsselwörter der Frame-Weiterleitung (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsUpdateRecord(
        string $domain,
        int $id,
        ?string $name,
        ?int $ttl,
        DnsRecordType $type,
        ?int $priority,
        string $content,
        ?string $uri = null,
        ?RedirectCode $redirectCode = null,
        ?string $favicon = null,
        ?string $title = null,
        ?string $desc = null,
        ?string $keywords = null,
    ): Response {
        return $this->connector->send(new DnsUpdateRecord($domain, $id, $name, $ttl, $type, $priority, $content, $uri, $redirectCode, $favicon, $title, $desc, $keywords));
    }

    /**
     * @param  int  $rrtemplateId  Resource-Record-Template-ID
     * @param  null|string  $name  Name des Resource-Record-Templates (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsUpdateRrtemplate(int $rrtemplateId, ?string $name = null): Response
    {
        return $this->connector->send(new DnsUpdateRrtemplate($rrtemplateId, $name));
    }

    /**
     * @param  int  $rrtemplateRecordId  Resource-Record-ID
     * @param  null|string  $name  Resource-Name (optional)
     * @param  null|int  $ttl  Gültigkeit der Resource (optional)
     * @param  DnsRecordType  $type  Resource-Typ
     * @param  null|int  $priority  Resource-Priorität (optional)
     * @param  string  $content  Resource-Data
     * @param  null|string  $uri  Ziel URL der Frame-/Header-Weiterleitung (optional)
     * @param  null|RedirectCode  $redirectCode  HTTP-Statuscode für die Header-Weiterleitung (optional)
     * @param  null|string  $favicon  URL zum Favoriten-Symbol der Frame-Weiterleitung (optional)
     * @param  null|string  $title  Titeltext der Frame-Weiterleitung (optional)
     * @param  null|string  $desc  Beschreibungstext der Frame-Weiterleitung (optional)
     * @param  null|string  $keywords  Schlüsselwörter der Frame-Weiterleitung (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsUpdateRrtemplateRecord(
        int $rrtemplateRecordId,
        ?string $name,
        ?int $ttl,
        DnsRecordType $type,
        ?int $priority,
        string $content,
        ?string $uri = null,
        ?RedirectCode $redirectCode = null,
        ?string $favicon = null,
        ?string $title = null,
        ?string $desc = null,
        ?string $keywords = null,
    ): Response {
        return $this->connector->send(new DnsUpdateRrtemplateRecord($rrtemplateRecordId, $name, $ttl, $type, $priority, $content, $uri, $redirectCode, $favicon, $title, $desc, $keywords));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  null|string  $primary  Primärer Nameserver für die Zone (optional)
     * @param  null|string  $mail  E-Mail-Adresse der Verantwortlichen für die Zone (optional)
     * @param  null|int  $refresh  Aktualisierung der sekundären Nameserver (optional)
     * @param  null|int  $retry  Erneuter Versuch der Aktualisierung der sekundären Nameserver (optional)
     * @param  null|int  $expire  Ablauf der Zone wenn kein Aktualisierung der sekundären Nameserver erfolgt (optional)
     * @param  null|int  $minimum  Minimum TTL der Resource Records (optional)
     * @param  null|int  $ttl  Gültigkeit der Resource (optional)
     * @param  int  $vnsId  ID eines virtuellen Nameservers
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function dnsUpdateZone(
        string $domain,
        ?string $primary,
        ?string $mail,
        ?int $refresh,
        ?int $retry,
        ?int $expire,
        ?int $minimum,
        ?int $ttl,
        int $vnsId,
    ): Response {
        return $this->connector->send(new DnsUpdateZone($domain, $primary, $mail, $refresh, $retry, $expire, $minimum, $ttl, $vnsId));
    }
}
