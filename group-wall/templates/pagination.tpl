
{if isset($next)}
		<A href="/{$controller}/{$action}/{$next}"><< Newer</A> {if isset($previous)}| {/if}
{/if}
{if isset($previous)}
		<A href="/{$controller}/{$action}/{$previous}">Older >></A>
{/if}
